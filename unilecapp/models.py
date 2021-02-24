from django.db import models

class UnilecModel(models.Model):
    name = models.CharField(max_length=25)
    penno = models.CharField(max_length=5)
    contact = models.IntegerField()

# Create your models here.
