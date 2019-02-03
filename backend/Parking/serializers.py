from rest_framework import serializers
from .models import Park, PotHole


class ParkSerializer(serializers.ModelSerializer):
    class Meta:
        model = Park
        fields = '__all__'


class PotholeSerializer(serializers.ModelSerializer):
    class Meta:
        model = PotHole
        fields = '__all__'
