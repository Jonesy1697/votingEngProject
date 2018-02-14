
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Christopher
 */
public class databaseConnect {
    
    String host;
    String uName;
    String uPass;
    Connection con;
    Statement stmt;
    ResultSet rs;
    party party;
    ArrayList<party> parties = new ArrayList<>();
    ArrayList<String> constituencies = new ArrayList<>();
    SimpleDateFormat sdf = new SimpleDateFormat ("yyyy-MM-dd");   
    
    public databaseConnect() throws SQLException {
            
        
        host = "jdbc:mysql://localhost/votingdb";
        uName = "root";
        uPass = "";
        
        con = DriverManager.getConnection(host, uName, uPass);
        
    }   
    
    public ResultSet getRS() {
        
        return rs;

    }
    
    public ArrayList<party> getParties(){
               
        return parties;
        
    }
    
    public boolean checkElectionDate() throws SQLException{
        
        String SQL;    
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT `electionDate` FROM `election` order by `electionDate` DESC;";
        rs = stmt.executeQuery(SQL);
        
        rs.first();
        
        Date now = new Date();
        
        if (sdf.format(now).equals(rs.getDate("electionDate"))){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    public void getLocalResults(String constituency) throws SQLException{
        
        String SQL;    
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT candidate.`party_Id`, COUNT(`candidate_ID`)\n" +
                "FROM vote INNER JOIN candidate on candidate.Id = candidate_ID\n" +
                "where candidate.constituency_Id =  \"" + constituency + "\"\n" +
                "group by candidate.party_Id\n" +
                "order by COUNT(`candidate_ID`) DESC";
        rs = stmt.executeQuery(SQL);
    }    
    
    public boolean checkUser(String ID, String pass, Date DOB) throws SQLException{
        
        String SQL;
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT ID, password, DOB FROM administrator where Id = " + ID;
        rs = stmt.executeQuery(SQL);     
        
        while (rs.next()) {
            if (rs.getString("ID").equals(ID)) {
                if (rs.getString("password").equals(pass)) {
                    if ( sdf.format(rs.getDate("DOB")).equals(sdf.format(DOB))){
                        return true;
                    }    
                }
            }
        }
        
        return false;
        
    }
    
    public boolean checkConstituency(String constituency) throws SQLException{
        
        String SQL;
        constituency = "\"" + constituency + "\"";
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT Id FROM constituency where Id = " + constituency;
        rs = stmt.executeQuery(SQL);
        
        int count = 0;
        
        while (rs.next()){
            
            count +=1;
            
        }
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT COUNT(vote.`Id`) \n" +
                "FROM vote INNER JOIN candidate on candidate.Id = candidate_ID\n" +
                "where candidate.constituency_Id = " + constituency;
                
        rs = stmt.executeQuery(SQL);
        rs.next();
                
        return (count != 0 && rs.getInt("COUNT(vote.`Id`)") != 0);
        
    }
    
    public void calculategetNationalResults() throws SQLException{
        
        clearLists();
        allParties();
        allConstituencies();
        
        for (String item : constituencies) {
            if (checkConstituency(item)){
                getLocalResults(item);
                rs.next();
                String winner = rs.getString("party_Id");

                for (party party : parties) {
                    if (party.getID().equals(winner)){

                        party.incSeats();

                    }
                }
            }
        }
        
        orderParties();
        
    }
    
    public void orderParties(){
               
        for (int i = 0; i < parties.size(); i++) {
            for (int j = 1; j < (parties.size() - i); j++) {
             if (parties.get(j - 1).getSeats() < parties.get(j).getSeats()) {
                party temp = parties.get(j - 1);
                parties.set(j - 1, parties.get(j));
                parties.set(j, temp);
                }
            }
        }
    }   
    
    public boolean partyExists(String party) throws SQLException{
        
        allParties();
        
        rs.first();        
        
        do{
            
            if (rs.getString("Id").equals(party)){
                
                return true;
                
            }            
        } while (rs.next());
        
        return false;
        
    }
    
    public void allParties() throws SQLException{
        
        String SQL;
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "Select ID from party";
        rs = stmt.executeQuery(SQL);
        
        while (rs.next()){
            party newParty = new party(rs.getString("Id"));
            parties.add(newParty);
        }        
    }
    
    public void allConstituencies() throws SQLException{
        
        
        String SQL;
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT ID FROM `constituency`";
        rs = stmt.executeQuery(SQL);
        
        while (rs.next()){
            constituencies.add(rs.getString("Id"));
        }
    }
    
    public void clearLists(){
        
        parties.removeAll(parties);
        constituencies.removeAll(constituencies);
        
    }
}
