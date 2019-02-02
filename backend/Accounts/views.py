from rest_framework.decorators import APIView
from .serializers import UserSerializer, UserLoginSerializer
from rest_framework.response import Response
from rest_framework import status
from django.contrib.auth.models import User
from django.contrib.auth import authenticate, login, logout

# Create your views here.


class UserLoginView(APIView):
    serializer_class = UserLoginSerializer
    queryset = User.objects.all()

    def post(self, request):
        username = request.data.get("username")
        password = request.data.get("password")
        print(username,password)
        if username is None or password is None:
            return Response({'error': 'Please provide both username and password'}, status=status.HTTP_204_NO_CONTENT)
        user = authenticate(username=username, password=password)
        print(user)
        if not user:
            return Response('0', status=status.HTTP_203_NON_AUTHORITATIVE_INFORMATION)
        print(login(request, user))
        return Response('1', status.HTTP_200_OK)


class UserView(APIView):
    serializer_class = UserSerializer
    queryset = User.objects.all()

    def post(self, request):
        print(request.data)
        serializer = UserSerializer(data=request.data)
        if serializer.is_valid(raise_exception=ValueError):
            serializer.create(validated_data=request.data)
            return Response('1', status.HTTP_201_CREATED)
        return Response(serializer.error_messages, status.HTTP_400_BAD_REQUEST)


def logoutUser(request):
    logout(request)
    pass
