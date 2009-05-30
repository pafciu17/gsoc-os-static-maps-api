from OSMTilesProcessing.imageCreator2 import ImageCreator
from OSMTilesProcessing.mapRequestData2 import MapRequestData

a1 = {'x': 5, 'y': 15}
a2 = {'x': 12, 'y': 3}



creator = ImageCreator(MapRequestData())
creator.getImage()