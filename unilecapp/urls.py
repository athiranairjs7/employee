from django.urls import path
from .import views

urlpatterns = [path('display/',views.display,name = 'display'),path('add/',views.add_edit,name = 'add'),
                path('edit/<int:id>/',views.add_edit,name = 'edit'),path('delete/<int:id>/',views.delete,name = 'delete')]