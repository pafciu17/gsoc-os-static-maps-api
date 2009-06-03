
class RawMap:
    def __init__(self, tiles, sampleTile):
        self.setMeasuringTile(tiles[0][0])
        self.firstTile = tiles[0][0]
        self.tiles = tiles
        self.sampleTile = sampleTile

    def getImage(self):
        temporaryImageSizeInTiles = {'x': len(self.tiles[0]), 'y': len(self.tiles)}
        resultImage = Image.new("RGB",
        (temporaryImageSizeInTiles['x'] * self.sampleTile.parameters['width']
        , temporaryImageSizeInTiles['y'] * self.sampleTile.parameters['height']))
        x, y = 0, 0
        for row in tiles:
            for tile in row:
                resultImage.paste(tile.img, (x, y, x + self.sampleTile.parameters['width'],
                y + self.sampleTile.parameters['width']))
                x = x + self.sampleTile.parameters['width']
            y = y + self.sampleTile.parameters['height']
            x = 0
        return resultImage

    def setMeasuringTile(self, tile):
        self.pixelScale = tile

    def getPixelDistance(self, point):
        distance = self.getDistance(point)
        return {'x': latToPixels(distance['lat']), 'y': lonToPixels(distance['lon'])}

    def getDistance(self, point):
        return self.firstTile.getDistanceFromPoint(point)

    def lonAndLatToPixels(self, lon, lat):
        return self.tile.lonAndLatToPixels(lon, lat)