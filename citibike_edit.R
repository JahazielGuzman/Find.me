load("C:/Users/root/Downloads/trips.RData")

library(dplyr)
library(reshape)
library(data.table)
library(ggplot2)

interval <- 15*60

# load in the station capacity
stationcap <- read.csv("station_cap_new.csv")

#remove a column named X
stationcap$X = NULL

# available bikes for each station for each 15 minute interval
avail_bikes <- read.csv("station_available.csv")

setnames(avail_bikes, "time", "interval_15")

# convert the time in original trips data to 15 minute intervals. 
# Each starttime will round down to the closest
# 15 minute interval

trips_per_15 <- transform(trips, interval_15 = round(
     as.numeric(as.POSIXct(starttime,origin="1970-01-01"))/interval)*interval)

# isolate the columns we care about, the start and end stations
# and the intervals

trips_per_15 <- select(trips_per_15,interval_15,start.station.name,end.station.name)

##########################################################
# perform a melt. For each interval in our data we will
# have the stations that corresponded to either a start and
# an end station
##########################################################

trips_per_15 <- melt(trips_per_15, id.vars="interval_15")

#########################################################
# the variable column will contain start.station.name and
# end.station.name for each 15 minute interval
# we will group by 15 minute interval, and then group by
# each station name. Each station name will contain 
# start.station.name if a trip started at that station during that interval
# and end.station.name if a trip ends at that station during that interval. 
# it will also count the number of times a trip ended or started at that station per interval

trips_per_15 <- trips_per_15 %>% group_by (interval_15,value,variable) %>% summarize (num_trips = n())

# we negate the count corresponding to the number of
# departures from a station at any interval

trips_per_15 <- transform (trips_per_15, num_trips = ifelse (
     variable=='end.station.name',num_trips,-num_trips))


# calculate the change, which is arrivals - departures for each interval

master_dt <- trips_per_15 %>% group_by (interval_15, value) %>% summarize (change =  sum (num_trips))

master_dt <- data.table (master_dt)
setnames (master_dt, "value", "station.name")


# set the key as interval_15, sort it by 15 minute interval
# and station name
setkey (master_dt, interval_15, station.name)

avail_bikes <- data.table(avail_bikes)

setkey (avail_bikes, interval_15, station.name)

########################################################################
########## merge bike availability in avail_bikes and 
##### trips_per_15 by 15 min interval and station

# add any intervals that dont exist for each station
master_dt <- merge ( avail_bikes, master_dt, all.x = T, 
     by = c( "interval_15", "station.name"))

master_dt[is.na(change)]$change = 0

master_dt <- master_dt [interval_15 >= 1372651200,] # get trips starting from july 01

#remove any unnecessary columns, only station name, 
# interval, bike availability and the change

master_dt <- select (master_dt, interval_15, station.name, 
    available_bikes = available_bikes, change_15 = change)

#############################################################
# add a ymd column giving the year, month and day
master_dt <- transform( master_dt, ymd = strftime ( as.POSIXct ( 
     interval_15, origin = "1970-01-01"), "%F" ) )

# add a new column giving which day of the week, 
# where monday is 1
master_dt <- transform(master_dt, weekday = as.POSIXct ( 
     interval_15, origin = "1970-01-01" ) )

master_dt <- transform ( master_dt, weekday = strftime(weekday, format="%u"))

# set a boolean testing whether the interval is on a 
# weekday or weekend
master_dt <- transform ( master_dt, is_weekday = ifelse ( 
     as.numeric( weekday ) < 6, TRUE, FALSE ))

##################################################

# get the hour for each interval
master_dt <- transform ( master_dt, hour = strftime (
     ( as.POSIXct( interval_15, origin = "1970-01-01" ) ) , format="%H"))

#use trips that are weekdays only
master_dt <- master_dt [ is_weekday == T ]

# limit to rows from july - november
master_dt <- master_dt[strftime(ymd,"%m") >= "07" & strftime(ymd,"%m") < "12",]

# count how many observations per station per day, take out any with less than 20
master_N <- master_dt [,.N, by = list ( station.name, ymd)]
master_N <- master_N [N < 20]

# remove rows where the station and time have less than 20 observations
master_dt <- master_dt[ ! ( station.name %in% master_N$station.name & ymd %in% master_N$ymd ) ]

# get the cumulative change
master_dt <- master_dt [, cumsum_15 := cumsum (change_15), by = c ("station.name")] # cumsum

########################################################
# set the month column for arrivals and departures data
trips_per_15 <- transform(trips_per_15, month = strftime( 
  as.POSIXct(interval_15,origin = "1970-01-01"), "%m")) 
  
# set day of week column for arrivals and departures data
trips_per_15 <- transform( trips_per_15, weekday = strftime(as.POSIXct( 
            interval_15,origin = "1970-01-01"), "%u"))

# remove any rows where the interval is before july and
# after november
trips_per_15 <- trips_per_15[as.character(
  trips_per_15$month) >= "07" & as.character(trips_per_15$month) < "12",]

# keep only rows corresponding to weekdays
trips_per_15 <- trips_per_15[as.numeric(trips_per_15$weekday) < 6,]

# make a seperate columns for departures and arrivals, using the start.station.name and end.station.name
trips_per_15 <- cast(
  select(          # trick cast to return the count for start and end stations after cast
    transform(trips_per_15, station.name = value, value = num_trips), 
    interval_15, station.name, variable, value), interval_15 + station.name ~ variable)

# set the names to arrivals and departures
###########################################
setnames(trips_per_15, "start.station.name", "departures")
setnames(trips_per_15, "end.station.name", "arrivals")

# set na's to 0
trips_per_15[is.na(trips_per_15$departures),]$departures = 0
trips_per_15[is.na(trips_per_15$arrivals),]$arrivals = 0

# make sure all departures give the actual amount
trips_per_15 <- transform(trips_per_15, departures = abs(departures))

####### get the day number and use this to get the number of
####### weekdays and weekends ###########

# order by station.name and then time
master_dt <- master_dt [ order ( master_dt$station.name, master_dt$interval_15)]

# compute the net transports, which is NT = current availability - previous
# availability - the previous change, for each station.
master_dt <- transform ( master_dt, NT = ifelse( 
     station.name == lag(station.name), available_bikes - lag(available_bikes) - lag(change_15), 0))

# merge with arrivals and departures, get the arrivals and departures for each interval
master_dt <- merge ( master_dt, trips_per_15, by=c("station.name", "interval_15"), all.x = TRUE)

# get an estimate for availability without teleports, e is the estimate
# and a is the availability and c is the change. 
# e[i] = a[i-1] + c[i-1] for i > 1 and e[1] = a[1] elsewhere

master_dt <- master_dt[, est_available := c ( 
     available_bikes[1],cumsum(change_15[1:(.N-1)]) + available_bikes[1]), 
     by=list(station.name,ymd)]

# set departures and arrivals that were NA to 0
# since these rows are not in the user trip data then
# we know there are 0 arrivals and departures for these
# rows
master_dt[is.na(departures)]$departures = 0
master_dt[is.na(arrivals)]$arrivals = 0

# function to divide x by y
bike_over_cap <- function(x,y) {
  return(x/y)
}

#

# master_dt <- master_dt[strftime(master_dt$ymd,"%m") %in% c("07","08","09","10","11")]

#### now merge the capacity for each station at each interval
### this is an intersection
master_dt <- merge(master_dt, stationcap, by="station.name")


#############################################################
# get the fraction of estimated bikes over station capacity
#############################################################

master_dt <- transform(master_dt,
                      percent_est_avail = bike_over_cap(est_available,station_capacity),
                      percent_avail = bike_over_cap(available_bikes,station_capacity))

# set each row as either ok, starved or congested using estimated avail
master_dt$station_est_condition = replicate(nrow(master_dt),"ok")
master_dt[percent_est_avail < .2]$station_est_condition = "starved"
master_dt[percent_est_avail > .8]$station_est_condition = "congested"

#set each row as either ok, starved or congested using actual avail
master_dt$station_condition = replicate(nrow(master_dt),"ok")
master_dt[percent_avail < .2]$station_condition = "starved"
master_dt[percent_avail > .8]$station_condition = "congested"

#add column giving the hour and minute for each interval
master_dt <- transform(master_dt, hour_min = strftime(as.POSIXct(interval_15,origin="1970-01-01"),"%R %P"))


#########################################################
# create new data.table that has the average percentage
# of ok, congested or starved stations per hour and
# minute based on estimated and actual availability
###########################################

# count hour minute observations then each condition within each hour and minute
# then compute percentage

# count how many observations per hour and minute 
# over all days and all station

master_dt[, num_hour_min := .N, by = hour_min ]  

# find number of starved, ok and congested for each hour and minute
master_dt[, num_cond_hour_min := .N, by = list (hour_min, station_condition)]

# find the number of starved, ok and congested for each hour and minute
# using the estimates
master_dt[, est_num_cond_hour_min := .N, by = list (hour_min, station_est_condition)]


# calculate percentages of ok, congested and starved stations
# for each hour and minute throughout the day

master_dt[, perc_hour_min := (num_cond_hour_min/num_hour_min),
         by = list (hour_min, station_condition)]

master_dt[, est_perc_hour_min := (est_num_cond_hour_min/num_hour_min), 
         by = list ( hour_min, station_est_condition)]

# compute the average percentage of condition per time interval
# first for actual availability then for estimates

master_dt_plot <- master_dt %>% group_by(hour_min, station_condition) %>%
  summarize(avg_cond_hrm = mean(perc_hour_min))

master_dt_plot2 <- master_dt %>% group_by(hour_min, station_condition) %>%
  summarize(est_avg_cond_hrm = mean(est_perc_hour_min))

# bind the starved, ok and congested stations for actual
# and estimated availability
master_dt_melt <- cbind(master_dt_plot, master_dt_plot2)

# get data in a format such that for each time interval and congested, ok
# and starved get the actual and estimated averages

master_dt_melt <- melt(master_dt_melt, id.vars = c ("hour_min","station_condition"))
master_dt_melt$averages <- with(master_dt_melt, paste0(station_condition, variable))


# plot congested and starved for actual availability over 15 minute interval
qplot(data=filter(master_dt_plot, station_condition != "ok"), x = hour_min,
      y = avg_cond_hrm, color=station_condition) +
  geom_line(aes(group = station_condition))

# generate congested and starved for both actual and estimated availability's
qplot(data=filter(master_dt_melt, station_condition != "ok"), x = hour_min,
      y = value, color=averages) +
  geom_line(aes(group = averages), size=1)

