from google.cloud.vision import types
from google.cloud import vision
from rest_framework.response import Response
from rest_framework import status
from .serializers import GarbageSerializer
from rest_framework.decorators import APIView, api_view
from .models import Garbage
import io
import os
os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = "/home/rashmit/Projects/O_Bug_Kal_Aana/DotSlash-dc45b2b1ba26.json"
# Imports the Google Cloud client library

# Instantiates a client
@api_view(['POST'])
def detectGarbage(request):
    client = vision.ImageAnnotatorClient()

    # The name of the image file to annotate
    file_name = request.FILES
    # Loads the image into memory
    with io.open(file_name, 'rb') as image_file:
        content = image_file.read()

    image = types.Image(content=content)

    # Performs label detection on the image file
    response = client.label_detection(image=image)
    labels = response.label_annotations

    for label in labels:
        print(label.description)


class GarbageView(APIView):
    serializer_class = GarbageSerializer
    queryset = Garbage.objects.all()

    def get(self, request):
        queryset = Garbage.objects.all()
        return Response({'garbage': GarbageSerializer(queryset, many=True).data}, status.HTTP_200_OK)

    def post(self, request):
        serializer = GarbageSerializer(data=request.data)
        print(request.FILES, request.data)
        if(serializer.is_valid()):
            g = Garbage.objects.create(garbage_img=request.FILES['garbage_img'], address=request.data['address'], longitude=request.data.get(
                'longitude'), latitude=request.data.get('latitude'))
            client = vision.ImageAnnotatorClient()

            # The name of the image file to annotate
            file_name = os.path.join(
                "/home/rashmit/Projects/O_Bug_Kal_Aana/backend/qrcode/",
                str(g.garbage_img))
            # Loads the image into memory
            with io.open(file_name, 'rb') as image_file:
                content = image_file.read()

            image = types.Image(content=content)

            # Performs label detection on the image file
            response = client.label_detection(image=image)
            labels = response.label_annotations

            garbageSet = [label.description for label in labels]
            inputSet = ["Garbage", "Litter", "Plastic", "Waste"]
            flag = False
            for objInput in inputSet:
                if objInput in garbageSet:
                    flag = True
                    break
            if(not flag):
                print("Yes")
                Garbage.objects.get(id=g.id).delete()
            return Response({'garbage': GarbageSerializer(g).data}, status.HTTP_201_CREATED)
        return Response(serializer.error_messages, status.HTTP_201_CREATED)
