
from tileSource import TileSourceMapnik

class MapRequest:
    #temporary data
    parameters = {'center': {'lat': -20, 'lon': -30}, 'zoom': 10,
    'size': {'width': 200, 'height': 300}}
    tileSource = TileSourceMapnik()