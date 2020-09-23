@include('admin.includes.alerts')


<div class="form-group">
    <label for="">Identify:</label>
    <input type="text" name="identify" class="form-control" placeholder="Nome" value="{{ $table->identify ?? old('identify')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" cols="30" rows="10" class="form-control">{{ $table->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>