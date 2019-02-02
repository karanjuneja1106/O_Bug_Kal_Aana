from rest_framework import serializers
from .models import Garbage


class GarbageSerializer(serializers.ModelSerializer):
    class Meta:
        model = Garbage
        fields = "__all__"
