from rest_framework.response import Response
from rest_framework import status
from .serializers import GarbageSerializer
from rest_framework.decorators import APIView
from .models import Garbage


class GarbageView(APIView):
    serializer_class = GarbageSerializer
    queryset = Garbage.objects.all()

    def get(self, request):
        queryset = Garbage.objects.all()
        return Response({'garbage': GarbageSerializer(queryset, many=True).data}, status.HTTP_200_OK)

    def post(self, request):
        serializer = GarbageSerializer(data=request.data)
        if(serializer.is_valid()):
            g = Garbage.objects.create(garbage_img=request.FILES['garbage_img'], address=request.data['address'], longitude=request.data.get(
                'longitude'), latitude=request.data.get('latitude'))
            return Response({'garbage': GarbageSerializer(g).data}, status.HTTP_201_CREATED)
        return Response(serializer.error_messages, status.HTTP_201_CREATED)
