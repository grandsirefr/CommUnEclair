function trieData(data){
    var dataTri=[];
    console.log(data);
    var idStationCourant;
    //var typeChargeCourant='';
    //var nbStation;
    //var memeType;
    var inc=0;
    
    for(var i=0;i<data.records.length;i++){
        
        //var dataTriLength=dataTri.length;
        idStationCourant = {id:'', nombre_Borne:1, borne_accelerer:0,borne_normale:0,adresse_rue:'',adresse_ville:'',paiement:'',tarif_general:'',acces_lieu:'',lat:'',long:''};
        idStationCourant.id=data.records[i].fields.id_station;
        if(i==0){
            dataTri[inc]=idStationCourant;
            
        }
        
        else if(idStationCourant.id == dataTri[inc].id){
            
            dataTri[inc].nombre_Borne++;
            /*if(data.records[i].fields.type_charge=='normale'){
                dataTri[inc].borne_normale++;
            }else{
                dataTri[inc].borne_accelerer++;
            }*/
            
        }else{
            inc++;
            dataTri[inc]=idStationCourant;
        }
        if(data.records[i].fields.type_charge=='normale'){
                dataTri[inc].borne_normale++;
            }else{
                dataTri[inc].borne_accelerer++;
            }
        dataTri[inc].acces_lieu=data.records[i].fields.acces_lieu;
        dataTri[inc].adresse_rue=data.records[i].fields.adresse_rue;
        dataTri[inc].adresse_ville=data.records[i].fields.adresse_ville;
        dataTri[inc].paiement=data.records[i].fields.paiement;
        dataTri[inc].tarif_general=data.records[i].fields.tarif_general;
        dataTri[inc].lat=data.records[i].geometry.coordinates[0];
        dataTri[inc].long=data.records[i].geometry.coordinates[1];
        
        //console.log(idStationCourant.id);
        //console.log(dataTri[inc]);
    
    
    
    }
    console.log(dataTri);
    return dataTri; 
}