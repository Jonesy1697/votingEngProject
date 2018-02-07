
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

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
    
    
    public databaseConnect() throws SQLException {
            
        
        host = "jdbc:mysql://localhost/votingdb";
        uName = "root";
        uPass = "";
        
        con = DriverManager.getConnection(host, uName, uPass);
        
    }   
    
    public ResultSet getRS() {
        
        return rs;

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
    
    public void checkConstituency(String constituency) throws SQLException{
        String SQL;
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT COUNT(`Id`) from constituency where `id` = \"" + constituency + "\";";
        System.out.println(SQL);
        rs = stmt.executeQuery(SQL);
        
    }
    
    public void getNationalResults() throws SQLException{
        
        getParties();
        getConstituencies();
        
        for (String item : constituencies) {
            System.out.println(item);
        }
        
    }
    
    public void getParties() throws SQLException{
        
        String SQL;
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "Select ID from party";
        rs = stmt.executeQuery(SQL);
        
        while (rs.next()){
            party newParty = new party(rs.getString("Id"));
            parties.add(newParty);
        }        
    }
    
    public void getConstituencies() throws SQLException{
        
        
        String SQL;
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT ID FROM `constituency`";
        rs = stmt.executeQuery(SQL);
        
        while (rs.next()){
            constituencies.add(rs.getString("Id"));
        }
    }
}
