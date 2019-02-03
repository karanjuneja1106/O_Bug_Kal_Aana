from django.conf.urls import url
from . import views

app_name = "Parking"

urlpatterns = [
    url(r'getStatus/$', views.ParkSlotList.as_view(), name="getStatus"),
    url(r'addPothole/$', views.PotHoleView.as_view(), name="addPothole"),
    url(r'listPothole/$', views.PotHoleList.as_view(), name="listPothole"),
    url(r'changeStatus/$', views.changeStatus, name="changeStatus")
]
