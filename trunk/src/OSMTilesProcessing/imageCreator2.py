import Image
import math
import urllib
import cStringIO
import tile
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

    ##
    # cut the result map out of initail image
    # @param firstTile, most to the left and up tile
    # @param initialImage
    # @return Image
    def cutOutMapImage(self, firstTile, initialImage):
        distanceFromCenterPoint = firstTile.getDistanceFromPoint(self.mapData.center)
        pixelDistanceFromCenterPoint = {}
        pixelDistanceFromCenterPoint['x'] = int((distanceFromCenterPoint['x'] * \
        tile.lonToPixels(1, self.mapData.zoom, firstTile.parameters['width'])))
        pixelDistanceFromCenterPoint['y'] = int((distanceFromCenterPoint['y'] * \
        tile.latToPixels(1, self.mapData.zoom, firstTile.parameters['height'])))

        # set left up and right up corner of the result image
        leftUp['x'] = int(pixelDistanceFromCenterPoint['x'] - self.mapData.size['width'] / 2)
        leftUp['y'] = int(pixelDistanceFromCenterPoint['y'] - self.mapData.size['height'] / 2)
        rightDown['x'] = leftUp['x'] + self.mapData.size['width']
        rightDown['y'] = leftUp['y'] + self.mapData.size['height']

        # control if map is fitted to image size
        if leftUp['y'] < 0:
            leftUp['y'] = 0
        if rightDown['y'] > initialImage.size[1]:
            rightDown['y'] = initialImage.size[1]

        # calculate result map size
        mapSize = {'width': rightDown['x'] - leftUp['x'], 'height': rightDown['y'] - leftUp['y']}

        # create result image
        resultImage = initialImage.transform((mapSize['width'], mapSize['height']) \
        , Image.EXTENT, (leftUp['x'], leftUp['y'], rightDown['x'], rightDown['y']))
 
        return resultImage

    ##
    # gets tiles and concatenates them to result image
    # @param tiles list, two dimensional list of tiles
    # @return resultImage Image
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


        self.cutOutMapImage(firstTile, resultImage)
     
        return resultImage


        