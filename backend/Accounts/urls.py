from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^createUser/$', views.UserView.as_view(), name='createUser'),
    url(r'^loginUser/$', views.UserLoginView.as_view(), name='loginUser')
]
