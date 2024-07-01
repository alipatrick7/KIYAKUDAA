@extends('layouts.admin')
@section('content')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a>Tailles de produits</a></li>
					</ol>
                </div>
                <!-- row -->

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Listes de tailles</h4>
								<button type="button" class="btn btn-rounded btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
									<span class="btn-icon-start text-black"><i class="fa fa-plus color-success"></i></span>
									Ajouter
								</button>
								<!-- Modal start-->
								<div class="modal fade" id="exampleModalCenter">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Ajouter une taille</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<div class="modal-body">
												<form action="{{ route('CREER-TAILLE') }}" method="POST">
													@csrf
													<div class="mb-3">
														<input class="form-control" type="text" name="taille_produit" placeholder="saisissez la taille" required>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fermer</button>
														<button type="submit" class="btn btn-success">Valider <span class="btn-icon-end"><i class="fa fa-check"></i></span></button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- Modal end-->
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <ul class="list-group">
										@foreach($tailles as $taille)
                                        <li class="list-group-item d-flex justify-content-between align-items-center"value="{{$taille->id}}">
											{{$taille->taille_produit}}
											<div class="d-flex">
                                                <button class="btn btn-danger shadow btn-xs sharp" onclick="confirmDelete({{ $taille->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $taille->id }}" action="{{ route('SUPP-TAILLE', $taille->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
											</div>
                                        </li>
										@endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
 @endsection

 @section('scripts')
<script>
    function confirmDelete(idTaille) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Cette action est irréversible!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire de suppression
                document.getElementById('delete-form-' + idTaille).submit();
            }
        });
    }
</script>
@if(Session::has('success'))
<script>
    toastr.success("{{ Session::get('success') }}", "Succès", {
        positionClass: "toast-top-right",
        closeButton: true,
        progressBar: true,
        timeOut: 5000,
        extendedTimeOut: 2000,
        tapToDismiss: false,
    });
</script>
@endif
@endsection