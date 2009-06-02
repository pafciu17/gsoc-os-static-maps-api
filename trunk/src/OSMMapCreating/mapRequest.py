
from tileSource import TileSourceMapnik

class MapRequest:
    #temporary data
    parameters = {'center': {'lat': -20, 'lon': -30}, 'zoom': 4,
    'size': {'width': 500, 'height': 300}}
    tileSource = TileSourceMapnik()