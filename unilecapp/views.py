from django.shortcuts import render,redirect
from .models import UnilecModel
from .forms import UnilecForms

def add_edit(request,id=0):
    if request.method == 'GET':
        if id == 0:
            form = UnilecForms()
            return render(request,'index.html',{'form':form})
        else:
            get_data = UnilecModel.objects.get(pk = id)
            form = UnilecForms(instance=get_data)
            return render(request,'unilecedit.html',{'get_data':get_data})
        
    else:
        if id == 0:
            form = UnilecForms(request.POST)
        else:
            get_data = UnilecModel.objects.get(pk = id)
            form = UnilecForms(request.POST,instance=get_data)
        form.save()
        return redirect('/unilec/display/')

def display(request):
    content = UnilecModel.objects.all()
    return render(request,'display.html',{'content':content})

def delete(request,id):
    delete_data = UnilecModel.objects.get(pk = id)
    delete_data.delete()
    return redirect('/unilec/display/')

