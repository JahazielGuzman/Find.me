<html>
<head>
<script src="/js_files/jquery_crop/scripts/jquery.imgareaselect.pack.js" type="text/javascript"></script>
<script>
var crop;
var bill = false;
var x;
var y;
var width;
var height;
 crop = crop.imgAreaSelect({
                instance: true,
                onInit: function (img,selection) {
                    $('.undefined-outer imgareaselect-outer').mousedown(function () {
                         bill = true;
                    });
                },
                onSelectEnd: function (img, selection) {
                $('#picture_upload_tool').text(img.src + " " + img.width + " " + img.height);
                if (bill == true) {
                     x = selection.x1;
                     y = selection.y1;
                     width = selection.width;
                     height = selection.height;
                     }
                     else {
                           x = 0;
                           y = 0;
                           width = img.width;
                           height = img.height;
                           
                     }
                     }
                });

               
        
        crop.update();
        crop.setOptions({
        handles: true,
        aspectRatio: '1:1',
        show: true,
        minHeight: '100',
        minWidth: '100',
        resizable: true,
        persistent: false
    });
    
    }
    });
</script>
</head>
<body>
<p>
<img src="http://4.bp.blogspot.com/_isUvlzkZPIQ/TOebFEusL8I/AAAAAAAAHB8/i2LTVPS_M9I/s1600/hot+blonde+model+photo+nerissa+starr+tight+panties.jpg" width="300" height="300"/>
</p>
</body>
</html>
