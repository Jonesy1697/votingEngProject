
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

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
    
    public databaseConnect() throws SQLException {
            
        
        host = "jdbc:mysql://localhost/votingdb";
        uName = "root";
        uPass = "";
        
        con = DriverManager.getConnection(host, uName, uPass);
        
    }   
    
    public ResultSet getRS() {
        
        return rs;

    }
    
    public void getLocalResults() throws SQLException{
        
        String constituency;
        String SQL;
        
        stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
        SQL = "SELECT candidate.`party_Id`, COUNT(`candidate_ID`)\n" +
                "FROM vote INNER JOIN candidate on candidate.Id = candidate_ID\n" +
                "where candidate.constituency_Id = \"Portsmouth South\"\n" +
                "group by candidate.party_Id\n" +
                "order by COUNT(`candidate_ID`) DESC";
        rs = stmt.executeQuery(SQL);
    }    
}
