import math

class Tile:
    def __init__(self, x, y, zoom, tileSource, load=True):
        self.parameters = {}
        if load:
            self.img = tileSource.loadImage(x, y, zoom)
        self.parameters['x'] = x
        self.parameters['y'] = y
        self.parameters['zoom'] = zoom

    def getLeftUpCorner(self):
        try:
            return self.leftUpCorner
        except AttributeError:
            self.leftUpCorner = num2deg(self.parameters['x'], \
            self.parameters['y'], self.parameters['zoom'])
            return self.leftUpCorner
        
    ##
    # gets distance input from left up corner of tile
    # @param point dictionary, with fields x and y
    # @return dictionary, x is lon distance and y is lat distance
    def getDistanceFromPoint(self, point):
        leftUpCorner = self.getLeftUpCorner()
        return {'lat': abs(point['lat'] - leftUpCorner['lat']), \
        'lon': abs(point['lon'] - leftUpCorner['lon'])}

##
# class represtents mapnik tile
class MapnikTile(Tile):
    
    # parameters specific for mapnik tiles
    def __init__(self, x, y, zoom, tileSource, load=True):
        Tile.__init__(self, x, y, zoom, tileSource, load)
        self.parameters['width'] = 256
        self.parameters['height'] = 256
    

def deg2num(lat_deg, lon_deg, zoom):
    lat_rad = lat_deg * math.pi / 180.0
    n = 2.0 ** zoom
    # FIXME this method should be correct, it does not return
    # correct y tile number if lat_ger is near to 90
    xtile = int((lon_deg + 180.0) / 360.0 * n)
    ytile = int((1.0 - math.log(math.tan(lat_rad) + (1 / math.cos(lat_rad))) / math.pi) / 2.0 * n)
    return{'x': xtile, 'y': ytile}

def num2deg(xtile, ytile, zoom):
    n = 2.0 ** zoom
    lon_deg = xtile / n * 360.0 - 180.0
    lat_rad = math.atan(math.sinh(math.pi * (1 - 2 * ytile / n)))
    lat_deg = lat_rad * 180.0 / math.pi
    return{'lat': lat_deg, 'lon': lon_deg}

def loadTileFromNumbers(x, y, zoom, tileSource):
    return tileSource.tileClass(x, y, zoom, tileSource)

def loadTileFromCoordinates(x, y, zoom, tileSource):
    tileNumbers = deg2num(y, x, zoom)
    return tileSource.tileClass(tileNumbers['x'], tileNumbers['y'], zoom, tileSource)

def worldWidthInTiles(zoom):
    return 2 ** zoom

def worldHeightInTiles(zoom):
    return 2 ** zoom

def correctTileNumber(x, y, zoom):
    worldWidth = worldWidthInTiles(zoom)
    worldHeight = worldHeightInTiles(zoom)
    #initial correct
    if x < 0:
        x = worldWidth + x
    elif x >= worldWidth:
        x = x - worldWidth
    if y < 0:
        y = 0;
    elif y >= worldHeight:
        y = worldHeight - 1

    #final correct, if all values ale really ok
    if x < 0:
        x = 0
    elif x >= worldWidth:
        x = worldWidth - 1
    return {'x': x, 'y': y}

##
# converts longitude to pixel for given zoom
#
# @param lon float longitude to convert
# @param zoom int
# @param tileWidth int, width is given in pixels
# @param return int
def lonToPixels(lon, zoom, tileWidth):
    pixelPerDegree = ((worldWidthInTiles(zoom)) * tileWidth) / 360.0
    print 'pixel per dergree - lonToPixel', pixelPerDegree
    return lon * pixelPerDegree

##
# converts latitude to pixel for given zoom
#
# @param lat float latitude to convert
# @param zoom int
# @param tileHeight int, height is given in pixels
# @param return int
def latToPixels(lat, zoom, tileHeight):

    pixelPerDegree = ((worldHeightInTiles(zoom)) * tileHeight) / 180.0
    print 'pixel per dergree - latToPixel', pixelPerDegree
    return lat * pixelPerDegree
