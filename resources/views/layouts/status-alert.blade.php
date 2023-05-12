@props(['color', 'status', 'mensaje', 'icono'])
<div class="{{'alert alert-dismissible fade show alert-label-icon alert-solid alert-'.$color}}" role="alert">
    <i class="{{'label-icon '.$icono}}"></i><strong>{{ $status }}!</strong> -
    {{ $mensaje }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
