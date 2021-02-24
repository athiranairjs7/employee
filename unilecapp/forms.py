from .models import UnilecModel
from django import forms

class UnilecForms(forms.ModelForm):
    class Meta:
        model = UnilecModel
        fields = '__all__'