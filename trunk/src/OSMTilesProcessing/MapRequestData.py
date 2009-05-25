class MapRequestData:
    longitude = 22.4
    latitude = 51.20
    zoom = 7
    width = 900
    height = 900

    def getTilesServerUrl(self, zoom, x, y):
        #change it
        return "http://tile.openstreetmap.org/%d/%d/%d.png" % (zoom, x, y)