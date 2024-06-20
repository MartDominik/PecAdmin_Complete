using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Security.Policy;
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
    /// Interaction logic for manualSzerkesztes.xaml
    /// </summary>
    public partial class manualSzerkesztes : Window
    {
        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);


        int id = 0;
        public manualSzerkesztes()
        {
            InitializeComponent();
            string select = $"SELECT allas, nev FROM `manualversenyzok` inner join manualversenyek on manualversenyek.id = manualversenyzok.versenyId WHERE allas is not null and manualversenyek.versenynev = '{ManualisWindow.versenynev}' order by allas asc";
            MySqlCommand cmd = new MySqlCommand(select, connect);
            connect.Open();
            MySqlDataReader olvaso = cmd.ExecuteReader();
            while (olvaso.Read())
            {
                listadoboz.Items.Add($"| {olvaso[0]} | {olvaso[1]} |");
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
            try
            {
                connect.Close();
                string a = listadoboz.SelectedItem.ToString();
                string[] adatok;
                adatok = a.Split('|');

                string select = $"SELECT manualversenyzok.id, nev, szektor, allas, fogas, nagyhal FROM `manualversenyzok` INNER join manualversenyek on manualversenyek.id = manualversenyzok.versenyId WHERE manualversenyek.versenynev = '{ManualisWindow.versenynev}' and allas = {adatok[1]};";
                MySqlCommand cmd = new MySqlCommand(select, connect);
                connect.Open();
                MySqlDataReader olvaso = cmd.ExecuteReader();
                while (olvaso.Read())
                {
                    id = int.Parse(olvaso[0].ToString());
                    nev.Text = olvaso[1].ToString();
                    szektor.Text = olvaso[2].ToString();
                    allas.Text = olvaso[3].ToString();
                    fogas.Text = olvaso[4].ToString();
                    nagyhal.Text = olvaso[5].ToString();
                }
                connect.Close();

            }
            catch (Exception)
            {

                MessageBox.Show("Szükségesek a verseny adatai");
            }

        }
        private void nagyhalhozzaad_Click(object sender, RoutedEventArgs e)
        {
            if (listadoboz.SelectedIndex >= 0)
            {
                if (fogas.Text != string.Empty || nev.Text != string.Empty || szektor.Text != string.Empty || nagyhal.Text != string.Empty || allas.Text != string.Empty)
                {
                    try
                    {
                        double doubleFogas = double.Parse(fogas.Text.ToString().Replace('.', ','));
                        double doubleNagyhal = double.Parse(nagyhal.Text.ToString().Replace('.', ','));

                        string strNagyhal = nagyhal.Text.ToString().Replace(',', '.');
                        string strFogas = fogas.Text.ToString().Replace(',', '.');

                        if (doubleNagyhal <= doubleFogas)
                        {

                            string updateStr = $"UPDATE `manualversenyzok` SET `nev`='{nev.Text}',`szektor`='{szektor.Text}',`allas`='{allas.Text}',`fogas`='{strFogas}',`nagyhal`='{strNagyhal}' where manualversenyzok.id = {id};";

                            MySqlCommand upd = new MySqlCommand(updateStr, connect);
                            connect.Open();
                            upd.ExecuteNonQuery();
                            connect.Close();


                            MessageBox.Show("Sikeres Szerkesztés!");
                        }
                        else
                        {
                            MessageBox.Show("A nagyhal súlya nem haladhatja meg a fogás súlyát!");
                        }


                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("Csak számot lehet megadni az állás vagy szektor mezőkbe! " + ex);
                    }
                }
                else
                {
                    MessageBox.Show("Töltse ki az összes mezőt");
                }
            }

            else
            {
                MessageBox.Show("Válaszzon ki egy versenyzőt!");
            }

            //listadoboz.Items.Clear();
            //string select = $"SELECT allas, nev FROM `manualversenyzok` inner join manualversenyek on manualversenyek.id = manualversenyzok.versenyId WHERE manualversenyek.versenynev = '{ManualisWindow.versenynev}' order by allas asc";
            //MySqlCommand cmd = new MySqlCommand(select, connect);
            //connect.Open();
            //MySqlDataReader olvaso = cmd.ExecuteReader();
            //while (olvaso.Read())
            //{
            //    listadoboz.Items.Add($"| {olvaso[0]} | {olvaso[1]} |");
            //}
            //connect.Close();
        }

    }
}
