from django.db import models


class Garbage(models.Model):
    garbage_img = models.ImageField(upload_to='garbage/', blank=True, null=True)
    address = models.CharField(max_length=1000)
    longitude = models.FloatField(null=True, blank=True)
    latitude = models.FloatField(null=True, blank=True)
