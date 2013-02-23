def getWidthHeight(name, x, y, width, height, newWidth, newHeight):
    #" 01.png",0,67,500,893,720,1280
    ratioX = newWidth/width
    ratioY = newHeight/height

    offsetX = x*(ratioX)*-1
    offsetY = y*(ratioY)*-1

    #width: 7280px;
    #height: 1920px;
    
    finalHeight = (1920)*ratioX
    finalWidth = (7280)*ratioY

    print "#s" + int(name[1:3]) + " {"
    
    print "\tposition: fixed;"

    print "\ttop: " + str(offsetY) + "px;"
    print "\tleft: " + str(offsetX) + "px;"

    print "\twidth: " + str(finalWidth) + "px;"
    print "\theight: " + str(finalHeight) + "px;"

    print "}"
    print ""


getWidthHeight(" 01.png",0,67,500,893,720,1280)
getWidthHeight(" 02.png",580,71,700,1245,720,1280)
getWidthHeight(" 03.png",1376,466,1511,850,1920,1080)
getWidthHeight(" 04.png",45,1420,893,500,1280,720)
getWidthHeight(" 05.png",1029,1420,893,500,1280,720)
getWidthHeight(" 06.png",2001,1420,893,500,1280,720)
getWidthHeight(" 07.png",2995,0,1080,1920,1080,1920)
getWidthHeight(" 08.png",4181,4,700,1245,720,1280)
getWidthHeight(" 09.png",4978,675,700,1245,720,1280)
getWidthHeight(" 10.png",5777,91,500,893,720,1280)
getWidthHeight(" 11.png",6375,93,893,500,1280,720)
getWidthHeight(" 12.png",5769,1067,1511,850,1920,1080)
