import math
import urllib
import cStringIO
from PIL import Image, ImageDraw
from OSMTilesProcessing.tilesProcessor import TilesProcessor

class ImageCreator:
    """class which creates map image"""
    


    def __init__(self, mapData):
        self.mapData = mapData
        self.tilesProcessor = TilesProcessor()

    def getImage(self):
        """create map image"""
        return self.__getImageFromTiles(self.tilesProcessor.getTiles(self.mapData))

    def __getImageFromTiles(self, tiles):
        temporaryImage = self.__concatenateImage(tiles)
        temporaryImage.show()
        print 'end'

    def __concatenateImage(self, tiles):
        firstTile = tiles[0][0]
        temporaryImageSizeInTiles = {'x': len(tiles[0]), 'y': len(tiles)}
        print 'temporaryImageSizeInTiles', temporaryImageSizeInTiles
        resultImage = Image.new("RGB", \
        [temporaryImageSizeInTiles['x'] * firstTile.parameters['width'] \
        , temporaryImageSizeInTiles['y'] * firstTile.parameters['height']])
        x, y = 0, 0
        
        for row in tiles:
            for tile in row:
                resultImage.paste(tile.img, (x, y, x + firstTile.parameters['width'], \
                y + firstTile.parameters['width']))
                x = x + firstTile.parameters['width']
            y = y + firstTile.parameters['height']
            x = 0

        print resultImage.size
        draw = ImageDraw.Draw(resultImage)
   

        resultImage.show()
        return resultImage

    def chopMapImage(self, initialImage):
        pass
        
        