<template>
    <div class="views">
        
        <div class="head">
            <i class="fas fa-briefcase"></i>
            <span>Postes</span>
        </div>

        <div class="button_search">
            <button class="btn btn-primary rounded-0" @click="addModal = true">Ajouter un Poste <i class="fas fa-plus"></i></button>
            <div class="search">
                <input type="search" class="form-control rounded-0" placeholder="Rechercher un poste">
            </div>
        </div> 

        <div class="tableaux table-responsive">
        
            <table class="table table-hover table-striped ">
            
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom du poste</th>
                        <th scope="col">Département</th>
                        <th scope="col">Responsabilité</th>
                        <th scope="col">Exigence</th>
                        <th scope="col">Description</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                </tbody>

            </table>

            <nav aria-label="Page navigation example" style="width: 100%;">
                <ul class="pagination justify-content-end w-100">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Modal Add Poste -->
        <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un Poste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="addModal = false" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nom du poste">
                            <label for="floatingInput">Nom du Poste</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" >
                                <option selected disabled>Selectionnez un département</option>
                                
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Responsabilité" cols="30" rows="10" style="height: 100px"></textarea>
                            <label for="floatingInput">Responsabilité</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Exigences" cols="30" rows="10" style="height: 100px"></textarea>
                            <label for="floatingInput">Exigences</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Description" cols="30" rows="10" style="height: 100px"></textarea>
                            <label for="floatingInput">Description</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" >
                                <option selected disabled>Selectionnez le statut</option>
                                <option value="vacant">Vacant</option>
                                <option value="pris">Pris</option>
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-0" @click="addModal = false" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary rounded-0">Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Add Poste -->

    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                addModal: false,
                AllDep:{}
            }
        },
        methods:{
            async Departement() {
                const res = await axios.get('/allDerps')
                if (res.data === 200) {
                    this.AllDep = res.data.deps
                    console.log(res.data)
                }
            }
        },
        created() {
            this.Departement()
        }
    }
</script>

<style>
    .head{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        width: 100%;
        height: 60px;
    }
    .head i{
        width: 40px;
        height: 40px;
        background: #050030;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 19px;
        border-radius: 10px;
    }
    .head span{
        font-size: 22px;
        font-weight: 500;
    }
    .button_search{
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 70px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
    }
    .button_search .search{
        width: 300px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tableaux{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        gap: 10px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
    }
</style>