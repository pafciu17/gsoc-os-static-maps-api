import math
import urllib
import cStringIO
from PIL import Image, ImageDraw

class ImageCreator:
    """class which creates map image"""
    tileOptions = {'width' : 256, 'height': 256}
    tileWidth, tileHeight = 0, 0
    middlePoint = None
    centerTile = None
    temporaryImageSizeInTiles = {'x': 0, 'y': 0}

    def __init__(self, mapData):
        self.mapData = mapData
        self.centerTile = self.deg2num(mapData.latitude, mapData.longitude, mapData.zoom)
        print 'self.centerTile: ', self.centerTile
        print 'self.mapData: ', self.mapData.longitude, self.mapData.latitude
        print 'self.leftUpCorner', self.num2deg(self.centerTile['x'], self.centerTile['y'], self.mapData.zoom)
        
    def getImage(self):
        return self.getImageFromTiles(self.getTilesNumbers(self.mapData))

    def setUpMiddlePoint(self):
        rightUpCorner = self.num2deg(self.centerTile['x'], self.centerTile['y'], self.mapData.zoom)
        self.pixelX = (self.tileWidth * self.tileOptions['width']) / 360.0
        self.pixelY = (self.tileHeight * self.tileOptions['height']) / 180.0
        print 'rightCorner', rightUpCorner
        print 'self.mapData', self.mapData.longitude, self.mapData.latitude
        self.middlePoint = {
            'x': abs(self.mapData.longitude - rightUpCorner['x']) * self.pixelX,
            'y': abs(self.mapData.latitude - rightUpCorner['y']) * self.pixelY
        }
        print 'middle Point: ', self.middlePoint
        return self.middlePoint

    def getLeftUpCorner(self):
        self.middlePoint
        x = int(abs(self.middlePoint['x'] - self.mapData.width / 2)) / self.tileOptions['width']
        y = int(abs(self.middlePoint['y'] - self.mapData.height / 2)) / self.tileOptions['height']
        if ((self.middlePoint['x'] - self.mapData.width / 2) < 0):
            x = x + 1
        if ((self.middlePoint['y'] - self.mapData.height / 2) < 0):
            y = y + 1
        print 'LeftUpCorner X and Y:', x, y
        x = self.centerTile['x'] - x;
        y = self.centerTile['y'] - y
        print 'leftUpCorner: ', x, y
        if x < 0:
            x = 0
        elif x >= self.tileWidth:
            x = x - self.tileWidth
        if y < 0:
            y = 0
        elif y > self.tileHeight:
            y = self.tileHeight - 1
        return {'x': x, 'y': y}

    def getRightDownCorner(self):
        x = int(self.middlePoint['x'] + self.mapData.width / 2) / self.tileOptions['width']
        y = int(self.middlePoint['y'] + self.mapData.height / 2) / self.tileOptions['height']
        if ((self.middlePoint['x'] + self.mapData.width / 2) > self.tileOptions['width']):
            x = x + 1
        if ((self.middlePoint['y'] - self.mapData.height / 2) > self.tileOptions['height']):
            y = y + 1
        x = self.centerTile['x'] + x
        y = self.centerTile['y'] + y
        if x < 0:
            x = 0
        elif x >= self.tileWidth:
            print 'x ', x
            x = x - self.tileWidth
            print 'x - self.tileWidht', x, self.tileWidth
        if y < 0:
            y = 0
        elif y > self.tileHeight:
            y = self.tileHeight - 1
        
        return {'x': x, 'y': y}
    
    def getTilesNumbers(self, mapaData):
        self.tileWidth = int(math.pow(2, self.mapData.zoom));
        print "!!!!!", self.tileWidth
        self.tileHeight = int(math.pow(2, self.mapData.zoom));
        self.setUpMiddlePoint()
        p1 = self.getLeftUpCorner()
        p2 = self.getRightDownCorner()
        print 'tilesy lewe i prawe: ', p1, p2
        return self.__createTileNumbersList(p1, p2)

    def __createTileNumbersList(self, p1, p2):
        tileNumbers = list()
        for i in range(p1['y'], p2['y'] + 1, 1):
            self.temporaryImageSizeInTiles['y'] = self.temporaryImageSizeInTiles['y'] + 1
            j = p1['x']
            end = False
            while not end:
                tileNumbers.append({'x': j, 'y': i})
                if j == p2['x']:
                    end = True
                j = j + 1
        self.temporaryImageSizeInTiles['x'] = len(tileNumbers) / self.temporaryImageSizeInTiles['y']
        print 'tile number list ', tileNumbers
        return tileNumbers

    def getImageFromTiles(self, tilesNumbers):
        images = list()
        for coordinates in tilesNumbers:
            images.append(self.getTile(coordinates))
        return self.chopImage(self.concatenateImages(images), tilesNumbers)

    def chopImage(self, image, tilesNumbers):
        leftUpTile = tilesNumbers.pop(0)
        print 'leftUpTile: ', leftUpTile
        print self.mapData.latitude, self.mapData.longitude, ' self.mapaData'
        tilesNumbers.insert(0, leftUpTile)
        leftUpPoint = self.num2deg(leftUpTile['x'], leftUpTile['y'], self.mapData.zoom)
        print 'leftUpPoint: ', leftUpPoint
        print 'self.mapData: ', self.mapData.longitude, self.mapData.latitude
        x = int((abs(self.mapData.longitude - leftUpPoint['x']) * self.pixelX) - \
            self.mapData.width / 2)
        y = int((abs(self.mapData.latitude - leftUpPoint['y']) * self.pixelY) - \
            self.mapData.height / 2)
        resultImage = Image.new("RGB", (self.mapData.width, self.mapData.height))
        print image.size
        w, h = image.size
        print "x and y: ", x, y
        resultImage.paste(image, ( -x, -y, w - x, h - y ))
        resultImage.show()

    def getTile(self, tileNumbers):
        file = urllib.urlopen(self.mapData.getTilesServerUrl(self.mapData.zoom, tileNumbers['x'], tileNumbers['y']))
        im = cStringIO.StringIO(file.read()) # constructs a StringIO holding the image
        img = Image.open(im)
        print 'getTile'
        return img

    def concatenateImages(self, images):
        resultImage = Image.new("RGB", (self.temporaryImageSizeInTiles['x'] * self.tileOptions['width']\
        , self.temporaryImageSizeInTiles['y'] * self.tileOptions['height']))
        x, y = 0, 0
        i = 1
        for img in images:
            resultImage.paste(img, (x, y, x + self.tileOptions['width'], \
            y + self.tileOptions['height']))
            if i >= self.temporaryImageSizeInTiles['x']:
                print 'tam'
                i = 1
                x = 0
                y = y + self.tileOptions['height']
            else:
                print 'tu'
                x = x + self.tileOptions['width']
                i = i + 1
        print resultImage.size
        draw = ImageDraw.Draw(resultImage)
        print 'rysuje: ', self.middlePoint
  
        draw.line((5, 5, self.middlePoint['x'], self.middlePoint['y']), fill = 128)
        resultImage.show()
        return resultImage

    def deg2num(self, lat_deg, lon_deg, zoom):
        lat_rad = lat_deg * math.pi / 180.0
        n = 2.0 ** zoom
        xtile = int((lon_deg + 180.0) / 360.0 * n)
        ytile = int((1.0 - math.log(math.tan(lat_rad) + (1 / math.cos(lat_rad))) / math.pi) / 2.0 * n)
        return{'x': xtile, 'y': ytile}
    
    def num2deg(self, xtile, ytile, zoom):
        n = 2.0 ** zoom
        lon_deg = xtile / n * 360.0 - 180.0
        lat_rad = math.atan(math.sinh(math.pi * (1 - 2 * ytile / n)))
        lat_deg = lat_rad * 180.0 / math.pi
        return{'y': lat_deg, 'x': lon_deg}
