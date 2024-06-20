using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
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
using System.IO;

namespace PecAdmin
{
    /// <summary>
    /// Interaction logic for versenyzoHozzadas.xaml
    /// </summary>
    public partial class versenyzoHozzadas : Window
    {

        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);
        int szektor = 0;
        int allas = 0;
        int befogadohelyek = 0;
        int versenyId = 0;


        public versenyzoHozzadas()
        {
            InitializeComponent();

            string select = $"SELECT manualversenyek.versenynev FROM `manualversenyek`";
            connect.Open();
            MySqlCommand Select_cmd = new MySqlCommand(select, connect);
            MySqlDataReader Reader = Select_cmd.ExecuteReader();
            while (Reader.Read())
            {
                verseny.Items.Add(Reader[0]);
            }
            connect.Close();


        }

        private void CloseButton_Click(object sender, RoutedEventArgs e)
        {
            Close();
        }
        private void MaxButton_Click(object sender, RoutedEventArgs e)
        {
            if (WindowState == WindowState.Normal)
            {
                WindowState = WindowState.Maximized;
            }
            else
            {
                WindowState = WindowState.Normal;
            }
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
        private void verseny_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {

            string Data = $"SELECT helyszineks.befogadohelyek, manualversenyek.id FROM `manualversenyek` INNER join helyszineks on helyszineks.id = manualversenyek.helyszinid WHERE manualversenyek.versenynev = '{verseny.SelectedItem}';";
            connect.Open();
            MySqlCommand Data_cmd = new MySqlCommand(Data, connect);
            MySqlDataReader Reader = Data_cmd.ExecuteReader();
            while (Reader.Read())
            {
                befogadohelyek = int.Parse(Reader[0].ToString());
                versenyId = int.Parse(Reader[1].ToString());
            }
            connect.Close();
        }

        private void Hozzaadas(object sender, RoutedEventArgs e)
        {
            // Lehet hogy nem a helyszineks táblábol hanem a manualtablaba kellene tolteni az ADOTT VERSENY maxletszam szamat ill szektorokat Validacio erdekeben!

            if (versenyzoneve.Text != string.Empty && szektorbeker.Text != string.Empty && allasbeker.Text != string.Empty && verseny.Text != string.Empty)
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
                        string ValidStr = $"SELECT allas FROM `manualversenyzok` where versenyId = {versenyId}";
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
                            MessageBox.Show("Már kilett osztva a " + allas + ". állás a "+ verseny.SelectedItem+" versenyen!");
                        }
                        else
                        {
                            try
                            {

                                string Insert_str = $"INSERT INTO `manualversenyzok`(`versenyId`, `nev`, `szektor`, `allas`) VALUES ((SELECT manualversenyek.id FROM manualversenyek WHERE manualversenyek.id = '{versenyId}'),'{versenyzoneve.Text}', {szektor}, {allas} )";
                                MySqlCommand Insert = new MySqlCommand(Insert_str, connect);
                                connect.Open();
                                Insert.ExecuteNonQuery();
                                connect.Close();

                                MessageBox.Show("Sikeres Létrehozás!");

                                versenyzoneve.Clear();
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
                catch (Exception ex)
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
//SELECT helyszineks.befogadohelyek FROM `manualversenyek` 
//INNER join helyszineks on helyszineks.id = manualversenyek.helyszinid 
//INNER JOIN manualversenyzok on manualversenyek.id = manualversenyzok.versenyId;
