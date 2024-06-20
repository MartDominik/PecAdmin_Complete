using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;

namespace PecAdmin
{
    /// <summary>
    /// Interaction logic for automatikusHozzarendeles.xaml
    /// </summary>
    public partial class automatikusHozzarendeles : Window
    {
        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);
        int szektor = 0;
        int allas = 0;
        int befogadohelyek = 0;
        int versenyId = 0;


        public automatikusHozzarendeles()
        {
            InitializeComponent();
            string select = $"SELECT nev FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{AutomatikusWindow.versenynev}'";
            MySqlCommand cmd = new MySqlCommand(select, connect);
            connect.Open();
            MySqlDataReader olvaso = cmd.ExecuteReader();
            while (olvaso.Read())
            {

                listadoboz.Items.Add(olvaso[0]);


            }
            connect.Close();
        }
        private void CloseButton_Click(object sender, RoutedEventArgs e)
        {
            Close();
        }
        private void MinButton_Click(object sender, RoutedEventArgs e)
        {
            WindowState = WindowState.Minimized;
        }

        private void topBar_MouseDown(object sender, MouseButtonEventArgs e)
        {
            if (e.ChangedButton == MouseButton.Left)
                this.DragMove();
        }

        private void listadoboz_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            

            string Data = $"SELECT helyszineks.befogadohelyek, hirdetes.id FROM `hirdetes` INNER join helyszineks on helyszineks.id = hirdetes.helyszinid INNER join jelentkezs on jelentkezs.hirdetId = hirdetes.id WHERE jelentkezs.nev = '{listadoboz.SelectedItem}';";
            connect.Open();
            MySqlCommand Data_cmd = new MySqlCommand(Data, connect);
            MySqlDataReader Reader = Data_cmd.ExecuteReader();
            while (Reader.Read())
            {
                ki.Content = $"{listadoboz.SelectedItem} kiválasztva!";

                befogadohelyek = int.Parse(Reader[0].ToString());
                versenyId = int.Parse(Reader[1].ToString());
            }
            connect.Close();
        
        }
        private void hozzzarendel_Click(object sender, RoutedEventArgs e)
        {

            if (szektorbeker.Text != string.Empty && allasbeker.Text != string.Empty)
            {
                try
                {
                    szektor = int.Parse(szektorbeker.Text);
                    allas = int.Parse(allasbeker.Text);

                    if (szektor <= 0 || allas <= 0)
                    {

                        MessageBox.Show("Nem lehet a szektor vagy az állás mező nulla vagy kevesebb");
                    }
                    else if (allas > befogadohelyek)
                    {
                        MessageBox.Show("Nem haladhatja meg az allas a befogadohelyek számát. (" + befogadohelyek + ")");
                    }
                    else
                    {
                        bool vanVnincs = false;
                        string ValidStr = $"SELECT allas FROM `jelentkezs` where hirdetId = {versenyId} and allas is NOT null;";
                        connect.Open();
                        MySqlCommand Valid_cmd = new MySqlCommand(ValidStr, connect);
                        MySqlDataReader Reader = Valid_cmd.ExecuteReader();
                        while (Reader.Read())
                        {


                            if (int.Parse(Reader[0].ToString()) == allas)
                            {
                                vanVnincs = true;
                            }


                        }
                        connect.Close();

                        if (vanVnincs == true)
                        {
                            MessageBox.Show("Már kilett osztva a " + allas + ". állás " + listadoboz.SelectedItem + "-nak(nek)!");
                        }
                        else
                        {
                            try
                            {

                                string Insert_str = $"UPDATE `jelentkezs` SET `szektor`={szektor},`allas`={allas} WHERE hirdetId = {versenyId} and nev = '{listadoboz.SelectedItem}';";
                                MySqlCommand Insert = new MySqlCommand(Insert_str, connect);
                                connect.Open();
                                Insert.ExecuteNonQuery();
                                connect.Close();

                                MessageBox.Show("Sikeres Létrehozás!");

                               
                                szektorbeker.Clear();
                                allasbeker.Clear();
                            }
                            catch (MySqlException ex)
                            {
                                connect.Close();
                                MessageBox.Show(ex.ToString());
                            }
                        }


                    }


                }
                catch (Exception)
                {

                    MessageBox.Show("Csak számot lehet megadni az állás vagy szektor mezőkbe!");
                }


            }
            else
            {
                MessageBox.Show("Töltse ki az összes mezőt!");
            }
        }
    }
}
