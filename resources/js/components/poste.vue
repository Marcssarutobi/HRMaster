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
                    <tr v-for="poste in allPost" :key="poste.id">
                        <td>{{ poste.name }}</td>
                        <td>{{ getDepName(poste.departement_id) }}</td>
                        <td>{{ poste.responsabiliter }}</td>
                        <td>{{ poste.exigences }}</td>
                        <td>{{ poste.description }}</td>
                        <td>{{ poste.statut }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h" ></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><span class="dropdown-item" @click="GetPoste(poste.id)"><i class="fas fa-pen"></i> Modifier</span></li>
                                    <li><span class="dropdown-item" @click="DeletePoste(poste.id)" > <i class="fas fa-trash" ></i> Supprimer</span></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

            <nav aria-label="Page navigation example" style="width: 100%;">
                <ul class="pagination justify-content-end w-100">
                    <li class="page-item" :class="currentPage === 1 ? 'disabled ' : ''">
                        <span class="page-link"  tabindex="-1" aria-disabled="true">Previous</span>
                    </li>
                   
                    <li class="page-item active" aria-current="page" v-for="page in totalPage" :key="page" :class="page === currentPage ? 'active' : ''">
                        <span class="page-link" @click="AllPoste(page)">{{ page }}</span>
                    </li>
                    
                    <li class="page-item" :class="currentPage === totalPage ? 'disabled' : ''">
                        <span class="page-link" >Next</span>
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
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nom du poste" v-model="data.name">
                            <label for="floatingInput">Nom du Poste</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" v-model="data.departement_id">
                                <option selected disabled>Selectionnez un département</option>
                                <option v-for="dep in allDeps" :key="dep.id" :value="dep.id">{{ dep.name }}</option>
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Responsabilité" cols="30" rows="10" style="height: 100px" v-model="data.responsabiliter"></textarea>
                            <label for="floatingInput">Responsabilité</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Exigences" cols="30" rows="10" style="height: 100px" v-model="data.exigences"></textarea>
                            <label for="floatingInput">Exigences</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Description" cols="30" rows="10" style="height: 100px" v-model="data.description"></textarea>
                            <label for="floatingInput">Description</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" v-model="data.statut" >
                                <option selected disabled>Selectionnez le statut</option>
                                <option value="vacant">Vacant</option>
                                <option value="pris">Pris</option>
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-0" @click="addModal = false" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary rounded-0" @click="AddPoste">Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Add Poste -->
        <!-- Modal Update Poste -->
        <div v-if="updateModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un Poste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="updateModal = false" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nom du poste" v-model="getPoste.name">
                            <label for="floatingInput">Nom du Poste</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" v-model="getPoste.departement_id">
                                <option selected disabled>Selectionnez un département</option>
                                <option v-for="dep in allDeps" :key="dep.id" :value="dep.id">{{ dep.name }}</option>
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Responsabilité" cols="30" rows="10" style="height: 100px" v-model="getPoste.responsabiliter"></textarea>
                            <label for="floatingInput">Responsabilité</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Exigences" cols="30" rows="10" style="height: 100px" v-model="getPoste.exigences"></textarea>
                            <label for="floatingInput">Exigences</label>
                        </div>
                        <div class="form-floating mb-3">
                           <textarea class="form-control" placeholder="Description" cols="30" rows="10" style="height: 100px" v-model="getPoste.description"></textarea>
                            <label for="floatingInput">Description</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" v-model="getPoste.statut" >
                                <option selected disabled>Selectionnez le statut</option>
                                <option value="vacant">Vacant</option>
                                <option value="pris">Pris</option>
                            </select>
                            <label for="floatingInput">Département Associé</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-0" @click="updateModal = false" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary rounded-0" @click="UpdatePostes" >Modifier</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Update Poste -->

    </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                addModal: false,
                allDeps: [],
                data: {
                    name: "",
                    departement_id: "",
                    responsabiliter: "",
                    exigences: "",
                    description: "",
                    statut:""
                },
                allPost: {},
                currentPage: 1,
                totalPage: 6,
                getPoste: {},
                updateModal: false
            }
        },
        methods:{
            
            async Departement() {
                try {
                    const res = await axios.get('/depart');
                    if (res.status === 200) { // Vérifie le statut de la réponse
                        this.allDeps = res.data.departements;
                        console.log(this.allDeps);
                    }
                } catch (error) {
                    console.error('Erreur lors de la récupération des départements :', error);
                }
            },
            async AddPoste(){
                try {

                    if (this.data.name.trim() == ""|| this.data.departement_id == "" || this.data.responsabiliter.trim() == "" || this.data.exigences.trim() == "" || this.data.description.trim() == "" || this.data.statut.trim() == "") {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Veuillez remplir tous les champs",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "error"
                        })
                        this.addModal = true
                    } else {
                        const res = await axios.post('/createposte', this.data)
                        if (res.status === 200) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                title: "Poste enrégistrer avec succès",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                icon: "success"
                            })
                            this.allPost.unshift(res.data.poste)
                            this.data.name = ""
                            this.data.departement_id = "",
                            this.data.responsabiliter = ""
                            this.data.exigences = ""
                            this.data.description = ""
                            this.data.statut = ""
                            this.addModal = false
                        }
                    }
                    
                } catch (error) {
                    console.log("Erreur : ",error)
                }
            },
            async AllPoste(page){
                try {
                    const res = await axios.get('/allPoste?page='+page)
                    if (res.status === 200) {
                        this.allPost = res.data.postes.data
                        this.currentPage = res.data.postes.current_page
                        this.totalPage = res.data.postes.last_page
                    }
                } catch (error) {
                    console.error('Erreur trouver :' , error)
                }
            },
            getDepName(id) {
                const departement = this.allDeps.find(dep => dep.id === id)
                return departement ? departement.name : ""
            },
            async GetPoste(id) {
                this.updateModal = true
                const res = await axios.get('/getPoste/' + id)
                if (res.status === 200) {
                    this.getPoste = res.data.poste
                }
            },
            async UpdatePostes() {

                try {
                    
                    if (this.getPoste.name.trim() == "" || this.getPoste.departement_id == "" || this.getPoste.responsabiliter.trim() == "" || this.getPoste.exigences.trim() == "" || this.getPoste.description.trim() == "" || this.getPoste.statut.trim() == "") {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Veuillez remplir tous les champs",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "error"
                        })
                        this.updateModal = true
                    } else {
                        const res = await axios.post('/updatePoste', this.getPoste)
                        if (res.status === 200) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                title: "Modification effectuer avec succès",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                icon: "success"
                            })
                            const index = this.allPost.findIndex(poste => poste.id === this.getPoste.id)
                            if (index !== -1) {
                                this.allPost[index] = this.getPoste
                            }
                            this.getPoste = {}
                            this.updateModal = false
                        }
                    }

                } catch (error) {
                    console.error('Erreur ici:', error)
                }
                
                
            },
            async DeletePoste(id) {
                const res = await axios.get('/getPoste/' + id)
                if (res.status === 200) {
                    this.getPoste = res.data.poste

                    Swal.fire({
                        title: "Voulez-vous supprimer ce Département ?",
                        text: "Vous ne pourrez plus revenir en arrière !",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Supprimer",
                        cancelButtonText: "Fermer"
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const ress = await axios.post('/delposte', this.getPoste)
                            if (ress.status === 200) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                const index = this.allPost.findIndex(poste => poste.id === this.getPoste.id)
                                if (index !== -1) {
                                    this.allPost.splice(index, 1)
                                }
                            }
                        }
                    })

                }
            }
            
        },
        created() {
            this.Departement()
            this.AllPoste()
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