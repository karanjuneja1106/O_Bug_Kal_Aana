# from datetime import date

# from django.shortcuts import get_object_or_404, render
# from qr_code.qrcode.utils import (ContactDetail, Coordinates, QRCodeOptions, WifiConfig)
from rest_framework import status
from rest_framework.response import Response

from .models import Park, PotHole
from .serializers import ParkSerializer, PotholeSerializer
from rest_framework.decorators import APIView, api_view
from rest_framework.generics import ListAPIView
from django.contrib.auth.models import User


class ParkSlotList(ListAPIView):
    serializer_class = ParkSerializer
    queryset = Park.objects.filter(user=None)


class PotHoleView(APIView):
    serializer_class = PotholeSerializer
    queryset = PotHole.objects.all()

    def post(self, request):
        p = PotHole.objects.create(latitude=request.data['latitude'], longitude=request.data['longitude'])
        return Response(PotholeSerializer(p).data, status.HTTP_201_CREATED)


class PotHoleList(ListAPIView):
    serializer_class = PotholeSerializer
    queryset = PotHole.objects.all()


@api_view(['POST'])
def changeStatus(request):
    print(request.body, request.data)
    data = request.data
    print(data)
    user = User.objects.get(username=data['userid'])
    slot = Park.objects.get(parking_number=int(data['slot']))
    slot.user = user
    slot.save()
    return Response("Success", status.HTTP_200_OK)
