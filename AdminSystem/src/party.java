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
    
    /**
     *
     * @param temp stores the party ID to be created
     */
    public party(String temp){
        
        Id = temp;
        seats = 0;
        
    }
    
    /**
     *
     * @return the ID of the party
     */
    public String getID(){
        
        return Id;
        
    }
    
    /**
     *
     * @return the number of seat a party has collected
     */
    public Integer getSeats(){
        
        return seats;
    
    }    
    
    /**
     *
     */
    public void incSeats(){
        
        seats++;
        
    }
}
