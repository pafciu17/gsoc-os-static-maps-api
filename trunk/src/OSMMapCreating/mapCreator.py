import tilesProcessor

#temporary import
from PIL.Image import Image

##
# creates map image for given map request
# @param mapRequest, request information
def createMap(mapRequest):
    # creates appropriate tiles processor
    processor = tilesProcessor.create(mapRequest)
    # creates and returns result map
    image = processor.createMap()
    # temporary image show
    image.show()
