
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
    
}
