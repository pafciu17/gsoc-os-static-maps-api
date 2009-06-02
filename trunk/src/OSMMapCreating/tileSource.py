import urllib
import cStringIO
from PIL import Image
import tile

##
# class contains logic for downloading tiles from particular server
class TileSource:

    ##
    # download tile from server
    # @param x int x-number of the tile
    # @param y int y-number of the tile
    # @param zoom int zoom-number of the tile
    # @return Image tile image
    def loadImage(self, x, y, zoom):
        file = self.getFile(x, y, zoom)
        im = cStringIO.StringIO(file.read()) # constructs a StringIO holding the image
        return Image.open(im)

    ##
    # class which open tile file, it has to be overwritten in subclasses
    def getFile(self, x, y, zoom):
        pass

##
# mapnik source
class TileSourceMapnik(TileSource):
    url = 'http://tile.openstreetmap.org/%d/%d/%d.png'
    tileClass = tile.MapnikTile
    sampleTile = tileClass(0, 0, 0, None, False)

    def getFile(self, x, y, zoom):
        return urllib.urlopen(self.url % (zoom, x, y))