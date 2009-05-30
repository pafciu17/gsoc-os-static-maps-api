import urllib
import cStringIO
from PIL import Image

class TileSource:
    url = "http://tile.openstreetmap.org/%d/%d/%d.png"

    def loadImage(self, x, y, zoom):
        print 'numer tiles: ', x, y, zoom
        file = urllib.urlopen(self.url % (zoom, x, y))
        im = cStringIO.StringIO(file.read()) # constructs a StringIO holding the image
        return Image.open(im)