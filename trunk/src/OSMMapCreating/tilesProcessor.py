from PIL import Image
import tile
from tile import Tile

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
        print 'test'
        self.mapRequest = mapRequest

    ##
    # creates map
    #
    def createMap(self):
        print 'createMap'
        return self.prepareMap(self.concatenateTiles(self.getTiles()))
        pass

    ##
    # gets tiles and concatenates them to result image
    #
    # @param tiles list, two dimensional list of tiles
    # @return Image
    def concatenateTiles(self, tiles):
        self.firstTile = tiles[0][0]
        temporaryImageSizeInTiles = {'x': len(tiles[0]), 'y': len(tiles)}
        resultImage = Image.new("RGB", 
        (temporaryImageSizeInTiles['x'] * self.mapRequest.tileSource.sampleTile.parameters['width']
        , temporaryImageSizeInTiles['y'] * self.mapRequest.tileSource.sampleTile.parameters['height']))
        x, y = 0, 0
        for row in tiles:
            for tile in row:
                resultImage.paste(tile.img, (x, y, x + self.firstTile.parameters['width'],
                y + self.firstTile.parameters['width']))
                x = x + self.firstTile.parameters['width']
            y = y + self.firstTile.parameters['height']
            x = 0

        resultImage.show()
        return resultImage

    def getTiles(self):
        print 'aaaaaa _getTiles'
        pass

    def prepareMap(self, tiles):
        pass

class TilesProcessorCreatesMapFromCenterPoint(TilesProcessor):

    def __init__(self, mapRequest):
        TilesProcessor.__init__(self, mapRequest)
        print 'TilesProcessorCreatesMapFromCenterPoint'


    def prepareMap(self, initialImage):
        distanceFromCenterPoint = self.firstTile.getDistanceFromPoint(
        self.mapRequest.parameters['center'])
        print 'centerPoint', self.mapRequest.parameters['center']
        print 'leftUpPoint', self.firstTile.getLeftUpCorner()
        print 'distanceFromCenterPoint', distanceFromCenterPoint
        pixelDistanceFromCenterPoint = {}
        pixelDistanceFromCenterPoint['x'] = int((distanceFromCenterPoint['lon'] * \
        tile.lonToPixels(1, self.mapRequest.parameters['zoom'],
        self.mapRequest.tileSource.sampleTile.parameters['width'])))

        pixelDistanceFromCenterPoint['y'] = int((distanceFromCenterPoint['lat'] * \
        tile.latToPixels(1, self.mapRequest.parameters['zoom'],
        self.mapRequest.tileSource.sampleTile.parameters['height'])))
        print 'mnoznik', str(tile.latToPixels(1, self.mapRequest.parameters['zoom'],
        self.mapRequest.tileSource.sampleTile.parameters['height']) * 11)
        print 'pixelDistanFromCenterPoint', pixelDistanceFromCenterPoint

        # set left up and right up corner of the result image
        leftUp = {}
        rightDown = {}
        leftUp['x'] = int(pixelDistanceFromCenterPoint['x'] \
        - self.mapRequest.parameters['size']['width'] / 2)
        leftUp['y'] = int(pixelDistanceFromCenterPoint['y'] \
        - self.mapRequest.parameters['size']['height'] / 2)
        rightDown['x'] = leftUp['x'] + self.mapRequest.parameters['size']['width']
        rightDown['y'] = leftUp['y'] + self.mapRequest.parameters['size']['height']

        print 'leftUp rightDown ', leftUp, rightDown

        # control if map is fitted to image size
        if leftUp['y'] < 0:
            leftUp['y'] = 0
        if rightDown['y'] > initialImage.size[1]:
            rightDown['y'] = initialImage.size[1]

        print leftUp, rightDown

        # calculate result map size
        mapSize = {'width': rightDown['x'] - leftUp['x'], 'height': rightDown['y'] - leftUp['y']}

        # create result image
        resultImage = initialImage.transform((mapSize['width'], mapSize['height']) \
        , Image.EXTENT, (leftUp['x'], leftUp['y'], rightDown['x'], rightDown['y']))

        return resultImage
    def getTiles(self):
        print '__getTiles'
        centerTile = tile.loadTileFromCoordinates(self.mapRequest.parameters['center']['lon'], 
        self.mapRequest.parameters['center']['lat'],  
        self.mapRequest.parameters['zoom'], self.mapRequest.tileSource)
        distanceInsideCenterTileFromLeftUpCorner = \
        centerTile.getDistanceFromPoint(self.mapRequest.parameters['center'])
        

        # lets take abs value distance, and calculate distance from leftUpCorner
        # of tile to center point of the requested map
        pixelDistanceInsideCenterTileFromLeftUpCorner = {}
        pixelDistanceInsideCenterTileFromLeftUpCorner['x'] = \
        abs(distanceInsideCenterTileFromLeftUpCorner['lon']) \
        * tile.lonToPixels(1, self.mapRequest.parameters['zoom'], centerTile.parameters['width'])
        pixelDistanceInsideCenterTileFromLeftUpCorner['y'] = \
        abs(distanceInsideCenterTileFromLeftUpCorner['lat']) \
        * tile.latToPixels(1, self.mapRequest.parameters['zoom'], centerTile.parameters['height'])

        # calculate how many tiles should be download
        pixelDistanceToLeftEndOfTheMap = int(self.mapRequest.parameters['size']['width'] / 2) 
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToRightEndOfTheMap = int(self.mapRequest.parameters['size']['width'] / 2)
        - int(centerTile.parameters['width'] 
        - pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToTopEndOfTheMap = int(self.mapRequest.parameters['size']['height'] / 2)
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['y'])
        pixelDistanceToBottomEndOfTheMap = int(self.mapRequest.parameters['size']['height'] / 2)
        - int(centerTile.parameters['width']
        - pixelDistanceInsideCenterTileFromLeftUpCorner['y'])

        left = 1 + pixelDistanceToLeftEndOfTheMap / centerTile.parameters['width']
        right = 1 + pixelDistanceToRightEndOfTheMap / centerTile.parameters['width']
        top = 1 + pixelDistanceToTopEndOfTheMap / centerTile.parameters['height']
        bottom = 1 + pixelDistanceToBottomEndOfTheMap / centerTile.parameters['height']

        print left, right, top, bottom

        leftUpTileNumber = {'x': centerTile.parameters['x'] - left, \
        'y': centerTile.parameters['y'] - top}
        rightDownTileNumber = {'x': centerTile.parameters['x'] + right, \
        'y': centerTile.parameters['y'] + bottom}

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
                print 'loop', x, y
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
        print 'TilesProcessorCreatesMapFromBoundaryPoints'
        
    def createMap(self, mapRequest):
        print 'TilesProcessorCreatesMapFromBoundaryPoints'
        