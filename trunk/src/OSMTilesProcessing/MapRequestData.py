class MapRequestData:
    longitude = 22.6
    latitude = 51.25
    zoom = 10
    width = 900
    height = 900

    def getTilesServerUrl(self, zoom, x, y):
        #change it
        wynik = "http://tile.openstreetmap.org/%d/%d/%d.png" % (zoom, x, y)
        print wynik
        return wynik