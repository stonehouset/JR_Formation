@extends('layouts.menu')

@section('content')
<div class="card-text" id="contenu_donnees">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                                Informations générales
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nombre d'utilisateurs
                                <span class="badge badge-primary badge-pill">10</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nouveaux messages
                                <span class="badge badge-primary badge-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Formulaire complété(s)
                                <span class="badge badge-primary badge-pill">1</span>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="col-lg-6">
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                                Gestion des utilisateurs
                            </button>
                            <button type="button" class="list-group-item list-group-item-action">Supprimer un utilisateur</button>
                            <button type="button" class="list-group-item list-group-item-action">Modifier données utilisateur</button>
                            <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                        Gestion des utilisateurs
                    </button>
                    <button type="button" class="list-group-item list-group-item-action">Supprimer un utilisateur</button>
                    <button type="button" class="list-group-item list-group-item-action">Modifier données utilisateur</button>
                    <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                    <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
                </div>
            </div>
        </div>
@endsection