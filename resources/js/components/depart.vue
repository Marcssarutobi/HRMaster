<template>
    <div class="views">
        
        <div class="head">
            <i class="fas fa-house-user"></i>
            <span>Département</span>
        </div> 

        <div class="button_search">
            <button @click="addDerp = true" class="btn btn-primary rounded-0">Département <i class="fas fa-plus"></i></button>
            <div class="search">
                <input type="search" class="form-control rounded-0" placeholder="Rechercher un département">
            </div>
        </div>

        <div class="tableaux table-responsive">
            
            <table class="table table-hover table-striped ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom Département</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dep in Departs" :key="dep.id">
                        <th scope="row">{{ dep.name }}</th>
                        <td>{{ dep.responsable }}</td>
                        <td>{{ dep.description }}</td>
                        <td>
                            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h" ></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><span class="dropdown-item" @click="getDerp(dep.id)" ><i class="fas fa-pen"></i> Modifier</span></li>
                                        <li><span class="dropdown-item" @click="DelDep(dep.id)"> <i class="fas fa-trash" ></i> Supprimer</span></li>
                                    </ul>
                                </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <nav aria-label="Page navigation example w-100" style="width: 100%;">
                <ul class="pagination justify-content-end w-100">
                    <li class="page-item " :class="currentPage === 1 ? 'disabled ' : ''">
                        <span class="page-link" tabindex="-1" aria-disabled="true">Previous</span>
                    </li>
                    
                    <li class="page-item " aria-current="page" v-for="page in totalPage" :key="page" :class="page === currentPage ? 'active' : ''">
                        <span class="page-link" @click="allProduits(page)">{{ page }}</span>
                    </li>
                   
                    <li class="page-item" :class="currentPage === totalPage ? 'disabled' : ''">
                        <span class="page-link" >Next</span>
                    </li>
                </ul>
            </nav>


        </div>

        <!-- Modal Add -->
        <div v-if="addDerp" class="Modals">
            <div class="Add_Derp">
            
                <div class="top">
                    <h3>Ajouter un département</h3>
                    <i @click="addDerp = false" class="fas fa-x"></i>
                </div>
                <div class="body">
                    <div class="form-floating w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Nom département" v-model="data.name">
                        <label for="floatingInput">Nom Département</label>
                    </div>
                    <div class="form-floating w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Responsable département" v-model="data.responsable">
                        <label for="floatingInput">Responsable Département</label>
                    </div>
                    <div class="form-floating w-100">
                        <textarea class="form-control" placeholder="Description Département" id="floatingTextarea2" style="height: 250px" v-model="data.description"></textarea>
                        <label for="floatingTextarea2">Description Département</label>
                    </div>
                </div>
                <div class="footer">
                    <div></div>
                    <div class="btns">
                        <button class="btn btn-outline-primary rounded-0 " @click="addDerp = false">Fermer</button>
                        <button class="btn btn-primary rounded-0 " @click="AddDep">Enrégistrer</button>
                    </div>
                </div>
            
            </div>
        </div>
        <!-- End Modal Add -->
        <!-- Modal update -->
            <div v-if="updateModal" class="Modals">
                <div class="Add_Derp">
            
                    <div class="top">
                        <h3>Ajouter un département</h3>
                        <i @click="updateModal = false" class="fas fa-x"></i>
                    </div>
                    <div class="body">
                        <div class="form-floating w-100">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nom département" v-model="getDepa.name">
                            <label for="floatingInput">Nom Département</label>
                        </div>
                        <div class="form-floating w-100">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Responsable département" v-model="getDepa.responsable">
                            <label for="floatingInput">Responsable Département</label>
                        </div>
                        <div class="form-floating w-100">
                            <textarea class="form-control" placeholder="Description Département" id="floatingTextarea2" style="height: 250px" v-model="getDepa.description"></textarea>
                            <label for="floatingTextarea2">Description Département</label>
                        </div>
                    </div>
                    <div class="footer">
                        <div></div>
                        <div class="btns">
                            <button class="btn btn-outline-primary rounded-0 " @click="updateModal = false">Fermer</button>
                            <button class="btn btn-primary rounded-0 " @click="UpdateDep">Enrégistrer</button>
                        </div>
                    </div>
            
                </div>
            </div>
            <!-- End Modal update -->

    </div>
</template>
<script>
import axios from 'axios'
import Swal from 'sweetalert2'
export default {
    name: "DepView",
    data() {
        return {
            addDerp: false,
            updateModal: false,
            data: {
                name: "",
                responsable: "",
                description: ""
            },
            Departs: {},
            currentPage: 1,
            totalPage: 6,
            getDepa:{}
        }        
    },
    methods: {
        async AddDep() {
            if (this.data.name.trim() == "" || this.data.responsable.trim() == "" || this.data.description.trim() == "") {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    title: "Veuillez remplir tous les champs",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error"
                })
                this.addDerp = true
            } else {
                const res = await axios.post('/create', this.data)
                if (res.status === 200) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        title: "Département enrégistrer avec succès",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "success"
                    })
                    this.Departs.unshift(res.data.departement)
                    this.data.name = ""
                    this.data.responsable = ""
                    this.data.description = ""
                    this.addDerp = false
                }
            }
        },
        async AllDeparts(page) {
            const res = await axios.get('/allDerp?page='+page)
            if (res.status === 200) {
                this.Departs = res.data.departements.data
                this.currentPage = res.data.departements.current_page
                this.totalPage = res.data.departements.last_page
            }
        },
        async getDerp(id) {
            this.updateModal = true
            const res = await axios.get('/getDep/' + id)
            if (res.status === 200) {
                this.getDepa = res.data.dep
            }
        },
        async UpdateDep() {
            if (this.getDepa.name.trim() == "" || this.getDepa.responsable.trim() == "" || this.getDepa.description.trim() == "") {
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
                const res = await axios.post('/updateDep', this.getDepa)
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
                    const index = this.Departs.findIndex(dep => dep.id === this.getDepa.id)
                    if (index !== -1) {
                        this.Departs[index] = this.getDepa
                    }
                    this.getDepa = {}
                    this.updateModal = false
                }
            }
        },
        async DelDep(id) {
            const res = await axios.get('/getDep/' + id)
            if (res.status === 200) {
                this.getDepa = res.data.dep


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
                        const ress = await axios.post('/delDep', this.getDepa)
                        if (ress.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Suppression effectuer",
                                showConfirmButton: false,
                                timer: 1500
                            })

                            const index = this.Departs.findIndex(dep => dep.id === this.getDepa.id)
                            if (index !== -1) {
                                this.Departs.splice(index, 1)
                            }
                        }
                    }
                })
            }
        }
    },
    created() {
        this.AllDeparts()
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
    .Modals{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 100;
        background-color: rgba(0, 0, 0, .7);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .Modals .Add_Derp{
        width: 650px;
        min-height: 500px;
        max-height: 100vh;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .Add_Derp .top{
        width: 100%;
        height: 15%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background: #e1e1e1;
    }
    .Add_Derp .top i{
        cursor: pointer;
    }
    .Add_Derp .body{
        width: 100%;
        height: 70%;
        padding: 1rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
    }
    .Add_Derp .footer{
        width: 100%;
        height: 15%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        border-top: 2px solid #ececec;
    }
    .Add_Derp .footer .btns{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .dropdown-item{
        cursor: pointer;
    }
    
</style>