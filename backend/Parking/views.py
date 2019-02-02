from datetime import date

from django.shortcuts import get_object_or_404, render
from qr_code.qrcode.utils import (ContactDetail, Coordinates, QRCodeOptions,
                                  WifiConfig)
from rest_framework import status
from rest_framework.response import Response

from .models import Park
from .serializers import ParkSerializer


def index(request):
    # Use a ContactDetail instance to encapsulate the detail of the contact.
    contact_detail = ContactDetail(
        first_name='John',
        last_name='Doe',
        first_name_reading='jAAn',
        last_name_reading='dOH',
        tel='+41769998877',
        email='j.doe@company.com',
        url='http://www.company.com',
        birthday=date(year=1985, month=10, day=2),
        address='Cras des Fourches 987, 2800 Delémont, Jura, Switzerland',
        memo='Development Manager',
        org='Company Ltd',
    )

    # Use a WifiConfig instance to encapsulate the configuration of the connexion.
    wifi_config = WifiConfig(
        ssid='my-wifi',
        authentication=WifiConfig.AUTHENTICATION.WPA,
        password='wifi-password'
    )

    # Build coordinates instances.
    google_maps_coordinates = Coordinates(latitude=586000.32, longitude=250954.19)
    geolocation_coordinates = Coordinates(latitude=586000.32, longitude=250954.19, altitude=500)

    # Build context for rendering QR codes.
    context = dict(
        contact_detail=contact_detail,
        wifi_config=wifi_config,
        video_id='J9go2nj6b3M',
        google_maps_coordinates=google_maps_coordinates,
        geolocation_coordinates=geolocation_coordinates,
        options_example=QRCodeOptions(size='t', border=6, error_correction='L'),
    )

    # Render the index page.
    return render(request, 'index.html', context=context)


def details(request, pk):
    obj = get_object_or_404(Park, id=pk)
    return obj
