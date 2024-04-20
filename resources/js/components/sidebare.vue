<template>
    <div class="mains">
        
        <div class="sidebar">
            <div class="logo">
                <h3>HRMaster</h3>
            </div>
            <div class="links">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-house"></i>
                            <span>Acceuil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-user"></i>
                            <span>Employer</span>
                        </a>
                    </li>
                    <li>
                        <router-link to="/poste">
                            <i class="fas fa-briefcase"></i>
                            <span>Poste</span>
                        </router-link>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-simple"></i>
                            <span>Evaluation</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-user-group"></i>
                            <span>Formation</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-file"></i>
                            <span>Document</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="view">
            <div class="navbars">
                <i class="fas fa-bars"></i>
                <div class="search">
                    <input type="search" placeholder="Rechercher ...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="config">
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <router-view/>
        </div>

    </div>
</template>

<script>
    export default {
        name:"SideBar"
    }
</script>

<style>
    .mains{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100vh;
    }
    .sidebar{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 300px;
        height: 100vh;
        background: #050030;
    }
    .sidebar .logo{
        width: 100%;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #09005a;
    }
    .sidebar .logo h3{
        font-size: 25px;
        font-weight: 600;
        color: #fff;
    }
    .sidebar .links{
        width: 100%;
        height: 100%;
        padding: 20px;
    }
    .sidebar .links ul{
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap: 10px;
        width: 100%;
        list-style: none;
    }
    .sidebar .links ul li{
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .links ul li a{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        text-decoration: none;
        color: #fff;
        gap: 15px;
        padding: 0 10px;
        border-radius: 10px;
    }
    .links ul li a:hover{
        background: #09005a;
    }
    .links ul li a i{
        width: 20px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .links ul li a span{
        width: 80px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        font-size: 18px;
    }

    .view{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
    }
    .navbars{
        width: 100%;
        height: 70px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;  
    }
    .navbars .fa-bars{
        font-size: 20px;
        cursor: pointer;
    }
    .navbars .search{
        width: 400px;
        height: 35px;
        background: #ececec;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        overflow: hidden;
    }
    .navbars .search input{
        width: 90%;
        height: 100%;
        border: none;
        outline: none;
        background: transparent;
        padding: 0 0 0 20px;
    }
    .navbars .search i{
        width: 10%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: #09005a;
        cursor: pointer;
    }
    .navbars .config{
        width: 80px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .navbars .config i{
        font-size: 20px;
        cursor: pointer;
    }
</style>