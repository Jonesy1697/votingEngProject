/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Christopher
 */
public class party {
    
    String Id;
    Integer seats;
    
    public party(String temp){
        
        Id = temp;
        seats = 0;
        
    }
    
    public String getID(){
        
        return Id;
        
    }
    
    public Integer getSeats(){
        
        return seats;
    
    }    
    
    public void incSeats(){
        
        seats++;
        
    }
}
