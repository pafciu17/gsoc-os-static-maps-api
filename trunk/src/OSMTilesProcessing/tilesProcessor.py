from OSMTilesProcessing import tile
from OSMTilesProcessing.tile import Tile



class TilesProcessor:
    def getTiles(self, mapData):
        """return tiles"""
        if mapData.center != None:
            tiles = self.loadFromCenterPoint(mapData)
        else:
            tiles = self.loadFromBoundaryPoints(mapData)
        return tiles

        ##
        # loads map tiles from given center point
        #
        # @param mapData MapRequestData
        # @return list
    def loadFromCenterPoint(self, mapData):
        

        centerTile = tile.loadTileFromCoordinates(mapData.center['x'], \
        mapData.center['y'], mapData.zoom, mapData.tileSource)

        

        print 'tu ', centerTile.getLeftUpCorner()
        print 'dystans ', centerTile.getDistanceFromPoint({'x': 20, 'y': 40})
        pixelDistanceInsideCenterTileFromLeftUpCorner = \
        centerTile.getDistanceFromPoint(mapData.center)

        #lets take abs value distance, and calculate distance from leftUpCorner
        #of tile to center point of the requested map
        pixelDistanceInsideCenterTileFromLeftUpCorner['x'] = \
        abs(pixelDistanceInsideCenterTileFromLeftUpCorner['x']) \
        * tile.lonToPixels(1, mapData.zoom, centerTile.parameters['width'])
        pixelDistanceInsideCenterTileFromLeftUpCorner['y'] = \
        abs(pixelDistanceInsideCenterTileFromLeftUpCorner['y']) \
        * tile.latToPixels(1, mapData.zoom, centerTile.parameters['height'])

        #calculate how many tiles should be download
        pixelDistanceToLeftEndOfTheMap = int(mapData.size['width'] / 2) \
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToRightEndOfTheMap = int(mapData.size['width'] / 2) \
        - int(centerTile.parameters['width'] \
        - pixelDistanceInsideCenterTileFromLeftUpCorner['x'])
        pixelDistanceToTopEndOfTheMap = int(mapData.size['height'] / 2) \
        - int(pixelDistanceInsideCenterTileFromLeftUpCorner['y'])
        pixelDistanceToBottomEndOfTheMap = int(mapData.size['height'] / 2) \
        - int(centerTile.parameters['width'] \
        - pixelDistanceInsideCenterTileFromLeftUpCorner['y'])

        print pixelDistanceInsideCenterTileFromLeftUpCorner
        print pixelDistanceToBottomEndOfTheMap
        print pixelDistanceToLeftEndOfTheMap
        print pixelDistanceToRightEndOfTheMap
        print pixelDistanceToTopEndOfTheMap

        left = 1 + pixelDistanceToLeftEndOfTheMap / centerTile.parameters['width']
        right = 1 + pixelDistanceToRightEndOfTheMap / centerTile.parameters['width']
        top = 1 + pixelDistanceToTopEndOfTheMap / centerTile.parameters['height']
        bottom = 1 + pixelDistanceToBottomEndOfTheMap / centerTile.parameters['height']

        print left, right, top, bottom
        
        leftUpTileNumber = {'x': centerTile.parameters['x'] - left, \
        'y': centerTile.parameters['y'] - top}
        rightDownTileNumber = {'x': centerTile.parameters['x'] + right, \
        'y': centerTile.parameters['y'] + bottom}

        #validate tile numbers
        leftUpTileNumber = tile.correctTileNumber(leftUpTileNumber['x'], \
        leftUpTileNumber['y'], mapData.zoom)
        rightDownTileNumber = tile.correctTileNumber(rightDownTileNumber['x'], \
        rightDownTileNumber['y'], mapData.zoom)

        print 'tilesy :', leftUpTileNumber, rightDownTileNumber

        endLoopY = False
        y = leftUpTileNumber['y']
        tiles = list()
        while not endLoopY:
            x = leftUpTileNumber['x']
            endLoopX = False
            row = list()
            while not endLoopX:
                print 'loop', x, y
                row.append(Tile(x, y, mapData.zoom, mapData.tileSource))
                if x == rightDownTileNumber['x']:
                    endLoopX = True
                x = x + 1
                tempXY = tile.correctTileNumber(x, y, mapData.zoom)
                x = tempXY['x']
                y = tempXY['y']
            tiles.append(row)
            if y == rightDownTileNumber['y']:
                endLoopY = True
            else:
                y = y + 1

        print 'tiles', tiles
        
        return tiles
        
        ##
        # loads map tiles from given boundary points
        #
        # @param mapData MapRequestData
        # @retur list
    def loadFromBoundaryPoints(self, mapData):
        
        pass