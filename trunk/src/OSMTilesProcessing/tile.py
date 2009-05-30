import math

class Tile:
    def __init__(self, x, y, zoom, tileSource):
        self.img = tileSource.loadImage(x, y, zoom)
        self.parameters = {'x': x, 'y': y, 'zoom': zoom, 'width': 256, 'height': 256}


    def getLeftUpCorner(self):
        try:
            return self.leftUpCorner
        except AttributeError:
            self.leftUpCorner = num2deg(self.parameters['x'], \
            self.parameters['y'], self.parameters['zoom'])
            return self.leftUpCorner

    def getWidth(self):
        return self.parameters['width']

    def getHeight(self):
        return self.parameters['height']

    def getDistanceFromPoint(self, point):
        leftUpCorner = self.getLeftUpCorner()
        return {'x': point['x'] - leftUpCorner['x'], \
        'y': point['y'] - leftUpCorner['y']}

def deg2num(lat_deg, lon_deg, zoom):
    lat_rad = lat_deg * math.pi / 180.0
    n = 2.0 ** zoom
    xtile = int((lon_deg + 180.0) / 360.0 * n)
    ytile = int((1.0 - math.log(math.tan(lat_rad) + (1 / math.cos(lat_rad))) / math.pi) / 2.0 * n)
    return{'x': xtile, 'y': ytile}

def num2deg(xtile, ytile, zoom):
    n = 2.0 ** zoom
    lon_deg = xtile / n * 360.0 - 180.0
    lat_rad = math.atan(math.sinh(math.pi * (1 - 2 * ytile / n)))
    lat_deg = lat_rad * 180.0 / math.pi
    return{'y': lat_deg, 'x': lon_deg}

def loadTileFromCoordinates(x, y, zoom, tileSource):
    print x, y, zoom
    tileNumbers = deg2num(y, x, zoom)
    print tileNumbers
    
    return Tile(tileNumbers['x'], tileNumbers['y'], zoom, tileSource)

def worldWidthInTiles(zoom):
    return 2 ** zoom

def worldHeightInTiles(zoom):
    return 2 ** zoom


def correctTileNumber(x, y, zoom):
    worldWidth = worldWidthInTiles(zoom)
    worldHeight = worldHeightInTiles(zoom)
    if x < 0:
        x = worldWidth + x
    elif x >= worldWidth:
        x = x - worldWidth
    if y < 0:
        y = 0;
    elif y >= worldHeight:
        y = worldHeight
    return {'x': x, 'y': y}



def lonToPixels(lon, zoom, tileWidth):
    pixelPerDegree = ((worldWidthInTiles(zoom)) * tileWidth) / 360.0
    return lon * pixelPerDegree

def latToPixels(lat, zoom, tileHeight):
    pixelPerDegree = ((worldHeightInTiles(zoom)) * tileHeight) / 360.0
    return lat * pixelPerDegree