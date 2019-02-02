from django.conf.urls import url
from . import views

app_name = "Parking"

urlpatterns = [
    url(r'uploadGarbage/$', views.GarbageView.as_view(), name="uploadGarbage"),
]
