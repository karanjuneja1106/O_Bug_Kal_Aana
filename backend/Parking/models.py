from django.db import models
from django.contrib.auth.models import User
import qrcode
# Create your models here.


class ParkingLot(models.Model):
    name = models.CharField(null=True, blank=True, max_length=256)
    longitude = models.FloatField(null=False, blank=False)
    latitude = models.FloatField(null=False, blank=False)


class Park(models.Model):
    parking_number = models.PositiveIntegerField()
    parkingLot = models.ForeignKey(ParkingLot, on_delete=models.CASCADE)
    user = models.ForeignKey(User, on_delete=models.CASCADE, null=True)
    park_time = models.DateTimeField(auto_now=True)
    qrcode = models.ImageField(upload_to='static/qrcode', blank=True, null=True)

    def save(self, *args, **kwargs):
        qr = qrcode.QRCode(
            version=1,
            error_correction=qrcode.constants.ERROR_CORRECT_L,
            box_size=10,
            border=4,
        )
        dataToShow = str(self.parkingLot.name)+'\n'+str(self.parking_number) + '\n' + 'Latitude: ' + \
            str(self.parkingLot.latitude) + '\n'+'Longitude: '+str(self.parkingLot.latitude)
        qr.add_data(dataToShow)
        qr.make(fit=True)

        filename = 'park-%s.png' % (Park.objects.all().count()+1)

        img = qr.make_image()
        img.save('qrcode/' + str(filename))
        super(Park, self).save(*args, **kwargs)
