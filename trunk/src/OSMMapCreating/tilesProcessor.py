from PIL import Image
import tile
from tile import Tile
from rawMap import RawMap

##
# factory method, for given mapRequest creates appropriate tiles processor
#
# @param mapRequest request data
# @return TilesProcessor
def create(mapRequest):
    try:
        mapRequest.parameters['center']
        return TilesProcessorCreatesMapFromCenterPoint(mapRequest)
    except KeyError:
        pass
    try:
        mapRequest.parameters['leftUp'], mapRequest.parameters['rightDown']
        return TilesProcessorCreatesMapFromBoundaryPoints(mapRequest)
    except KeyError:
        pass
    raise NoTilesProcessorError("tiles processor has not been created")

class NoTilesProcessorError(Exception):
    pass

class TilesProcessor:

    def __init__(self, mapRequest):
        self.mapRequest = mapRequest

    ##
    # creates map
    #
    def createMap(self):
        self.rawMap = RawMap(self.getTiles(), self.mapRequest.tileSource.sampleTile)
        return self.prepareMap()

    def getTiles(self):
        pass

    def prepareMap(self, tiles):
        pass

class TilesProcessorCreatesMapFromCenterPoint(TilesProcessor):

    def __init__(self, mapRequest):
        TilesProcessor.__init__(self, mapRequest)

    def prepareMap(self):


        self.rawMap.setMeasuringTile(self.centerTile)
        distance = self.getPixelDistance(self.mapRequest.center)
        leftUp['x'] = abs(int(distance['x'] - self.mapRequest.parameters['size']['width'] / 2))
        leftUp['y'] = abs(int(distance['y'] - self.mapRequest.parameters['size']['height'] / 2))
        rightDown['x'] = abs(int(leftUp['x'] + self.mapRequest.parameters['size']['width']))
        rightDown['y'] = abs(int(leftUp['y'] + self.mapRequest.parameters['size']['height']))
        return self.rawImage.getResultImage(leftUp, rightDown)

        # set left up and right up corner of the result image
        leftUp = {}
        rightDown = {}
        leftUp['x'] = int(pixelDistanceFromCenterPoint['x'] \
        - self.mapRequest.parameters['size']['width'] / 2)
        leftUp['y'] = int(pixelDistanceFromCenterPoint['y'] \
        - self.mapRequest.parameters['size']['height'] / 2)
        rightDown['x'] = leftUp['x'] + self.mapRequest.parameters['size']['width']
        rightDown['y'] = leftUp['y'] + self.mapRequest.parameters['size']['height']

        print leftUp, rightDown

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
    
    def getTiles(self):
      
        self.centerTile = tile.loadTileFromCoordinates(self.mapRequest.parameters['center']['lon'],
        self.mapRequest.parameters['center']['lat'],  
        self.mapRequest.parameters['zoom'], self.mapRequest.tileSource)
        distanceInsideCenterTileFromLeftUpCorner = \
        self.centerTile.getDistanceFromPoint(self.mapRequest.parameters['center'])

        print 'centerTile.getLeftUpCorner()', self.centerTile.getLeftUpCorner()
        self.centerTile.img.show()
        nextTile = tile.loadTileFromNumbers(self.centerTile.parameters['x'],
        self.centerTile.parameters['y'] + 1, self.centerTile.parameters['zoom'], self.mapRequest.tileSource)
        print 'nextTile.getLeftUpCorner() ', nextTile.getLeftUpCorner()
        pixelDistance = nextTile.getDistanceFromPoint(self.centerTile.getLeftUpCorner())
        print 'nextTile distance from centerTile ', pixelDistance
        print 'nextTile distance from centerTile, pixelDistance ', pixelDistance['lat'] * \
            tile.latToPixels(1, self.mapRequest.parameters['zoom'], self.centerTile.parameters['height'])
        # lets take abs value distance, and calculate distance from leftUpCorner
        # of tile to center point of the requested map
        pixelDistanceInsideCenterTileFromLeftUpCorner = {}
        pixelDistanceInsideCenterTileFromLeftUpCorner['x'] = \
        abs(distanceInsideCenterTileFromLeftUpCorner['lon']) \
        * tile.lonToPixels(1, self.mapRequest.parameters['zoom'], self.centerTile.parameters['width'])
        pixelDistanceInsideCenterTileFromLeftUpCorner['y'] = \
        abs(distanceInsideCenterTileFromLeftUpCorner['lat']) \
        * tile.latToPixels(1, self.mapRequest.parameters['zoom'], self.centerTile.parameters['height'])

        # calculate how many tiles should be download
        pixelDistanceToLeftEndOfTheMap = int(self.mapRequest.parameters['size']['width'] / 2) 
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToRightEndOfTheMap = int(self.mapRequest.parameters['size']['width'] / 2)
        - int(self.centerTile.parameters['width']
        - pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToTopEndOfTheMap = int(self.mapRequest.parameters['size']['height'] / 2)
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['y'])
        pixelDistanceToBottomEndOfTheMap = int(self.mapRequest.parameters['size']['height'] / 2)
        - int(self.centerTile.parameters['width']
        - pixelDistanceInsideCenterTileFromLeftUpCorner['y'])

        left = 1 + pixelDistanceToLeftEndOfTheMap / self.centerTile.parameters['width']
        right = 1 + pixelDistanceToRightEndOfTheMap / self.centerTile.parameters['width']
        top = 1 + pixelDistanceToTopEndOfTheMap / self.centerTile.parameters['height']
        bottom = 1 + pixelDistanceToBottomEndOfTheMap / self.centerTile.parameters['height']

        leftUpTileNumber = {'x': self.centerTile.parameters['x'] - left, \
        'y': self.centerTile.parameters['y'] - top}
        rightDownTileNumber = {'x': self.centerTile.parameters['x'] + right, \
        'y': self.centerTile.parameters['y'] + bottom}

        # validate tile numbers
        leftUpTileNumber = tile.correctTileNumber(leftUpTileNumber['x'], \
        leftUpTileNumber['y'], self.mapRequest.parameters['zoom'])
        rightDownTileNumber = tile.correctTileNumber(rightDownTileNumber['x'], \
        rightDownTileNumber['y'],self. mapRequest.parameters['zoom'])

        endLoopY = False
        y = leftUpTileNumber['y']
        tiles = list()
        while not endLoopY:
            x = leftUpTileNumber['x']
            endLoopX = False
            row = list()
            while not endLoopX:
                row.append(tile.loadTileFromNumbers(x, y, self.mapRequest.parameters['zoom'], self.mapRequest.tileSource))
                if x == rightDownTileNumber['x']:
                    endLoopX = True
                x = x + 1
                tempXY = tile.correctTileNumber(x, y, self.mapRequest.parameters['zoom'])
                x = tempXY['x']
                y = tempXY['y']
            tiles.append(row)
            if y == rightDownTileNumber['y']:
                endLoopY = True
            else:
                y = y + 1
        return tiles

class TilesProcessorCreatesMapFromBoundaryPoints(TilesProcessor):

    def __init__(self, mapRequest):
        TilesProcessor.__init__(self, mapRequest)
        
    def createMap(self, mapRequest):
        pass
        