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
using static Mysqlx.Notice.Warning.Types;

namespace PecAdmin
{
    /// <summary>
    /// Interaction logic for egyeniMerlegeles.xaml
    /// </summary>
    public partial class egyeniMerlegeles : Window
    {
        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);

        double jelenfogas = 0;
        double intmenyi = 0;

        double intnagyhal = 0;
        double jelennagyhal = 0;


        int lekertid = 0;

        bool mazli = false;


        public egyeniMerlegeles()
        {
            InitializeComponent();

            string select = $"SELECT allas, nev FROM `manualversenyzok` inner join manualversenyek on manualversenyek.id = manualversenyzok.versenyId WHERE manualversenyek.versenynev = '{ManualisWindow.versenynev}' order by allas asc";
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
            string a = listadoboz.SelectedItem.ToString();


            string[] adatok;
            adatok = a.Split('|');

            string select = $"SELECT fogas, manualversenyzok.id, nagyhal FROM `manualversenyzok` INNER join manualversenyek on manualversenyek.id = manualversenyzok.versenyId WHERE manualversenyek.versenynev = '{ManualisWindow.versenynev}' and allas = '{adatok[1]}';";
            MySqlCommand cmd = new MySqlCommand(select, connect);
            connect.Open();
            MySqlDataReader olvaso = cmd.ExecuteReader();
            while (olvaso.Read())
            {

                hol.Content = $"A(z) {adatok[1]}. álláson ülő";
                ki.Content = $"{adatok[2]} kiválasztva!";
                jelenmenny.Content = $"Jelenlegi fogása {olvaso[0]} kg.";

                jelenfogas = double.Parse(olvaso[0].ToString());
                lekertid = int.Parse(olvaso[1].ToString());
                jelennagyhal = double.Parse(olvaso[2].ToString());



            }
            connect.Close();






        }

        private void betoltes_Click(object sender, RoutedEventArgs e)
        {

        }



        private void hozzaad_Click(object sender, RoutedEventArgs e)
        {

            if (listadoboz.SelectedIndex >= 0)
            {
                if (mennyiseg.Text != string.Empty)
                {
                    try
                    {
                        intmenyi = double.Parse(mennyiseg.Text);


                        if (intmenyi <= 0)
                        {

                            MessageBox.Show("Nem lehet nullánál kevesebb!");
                        }
                        else
                        {


                            jelenfogas = jelenfogas + intmenyi;

                            string temp = jelenfogas.ToString().Replace(',', '.');

                            string updateStr = $"UPDATE `manualversenyzok` SET `fogas`={temp} WHERE id = '{lekertid}';";
                            MySqlCommand upd = new MySqlCommand(updateStr, connect);
                            connect.Open();
                            upd.ExecuteNonQuery();
                            connect.Close();
                            jelenmenny.Content = $"Jelenlegi fogása {jelenfogas} kg.";

                            jelenmenny.Content = $"Jelenlegi fogása {jelenfogas} kg.";


                            mennyiseg.Clear();

                        }


                    }
                    catch (Exception)
                    {

                        MessageBox.Show("Csak számot lehet megadni az állás vagy szektor mezőkbe!");
                    }


                }
                else
                {
                    MessageBox.Show("Töltse ki a mezőt!");
                }
            }
            else
            {
                MessageBox.Show("Válasszon ki egy versenyzőt!");
            }



        }

        private void nagyhalhozzaad_Click(object sender, RoutedEventArgs e)
        {
            if (listadoboz.SelectedIndex >= 0)
            {
                if (nagyhalmennyiseg.Text != string.Empty)
                {
                    try
                    {
                        intnagyhal = double.Parse(nagyhalmennyiseg.Text);


                        if (intnagyhal <= 0)
                        {

                            MessageBox.Show("Nem lehet nullánál kevesebb!");
                        }
                        else
                        {

                            string select = $"SELECT count(mazli) FROM `manualversenyzok` WHERE mazli != 0;";
                            MySqlCommand cmd = new MySqlCommand(select, connect);
                            connect.Open();
                            MySqlDataReader olvaso = cmd.ExecuteReader();
                            while (olvaso.Read())
                            {
                                if (int.Parse(olvaso[0].ToString()) != 0)
                                {
                                    mazli = true;
                                }
                            }
                            connect.Close();

                            if (mazli == true && jelennagyhal < intnagyhal)
                            {
                                jelenfogas = jelenfogas + intnagyhal;

                                string temp = jelenfogas.ToString().Replace(',', '.');
                                string temp2 = intnagyhal.ToString().Replace(',', '.');

                                string updateStr = $"UPDATE `manualversenyzok` SET `fogas`={temp}, `nagyhal`={temp2} WHERE id = '{lekertid}';";
                                MySqlCommand upd = new MySqlCommand(updateStr, connect);
                                connect.Open();
                                upd.ExecuteNonQuery();
                                connect.Close();

                                jelenmenny.Content = $"Jelenlegi fogása {jelenfogas} kg.";


                                nagyhalmennyiseg.Clear();
                            }
                            else if (mazli == true && jelennagyhal > intnagyhal)
                            {
                                jelenfogas = jelenfogas + intnagyhal;

                                string temp = jelenfogas.ToString().Replace(',', '.');

                                string updateStr = $"UPDATE `manualversenyzok` SET `fogas`={temp}  WHERE id = '{lekertid}';";
                                MySqlCommand upd = new MySqlCommand(updateStr, connect);
                                connect.Open();
                                upd.ExecuteNonQuery();
                                connect.Close();

                                jelenmenny.Content = $"Jelenlegi fogása {jelenfogas} kg.";


                                nagyhalmennyiseg.Clear();
                            }
                            else
                            {
                                jelenfogas = jelenfogas + intnagyhal;

                                string temp = jelenfogas.ToString().Replace(',', '.');
                                string temp2 = intnagyhal.ToString().Replace(',', '.');

                                string jelenido = DateTime.Now.ToString("h:mm:ss");

                                string updateStr = $"UPDATE `manualversenyzok` SET `fogas`={temp}, `nagyhal`={temp2}, `mazli`= '{jelenido}'  WHERE id = '{lekertid}';";
                                MySqlCommand upd = new MySqlCommand(updateStr, connect);
                                connect.Open();
                                upd.ExecuteNonQuery();
                                connect.Close();

                                jelenmenny.Content = $"Jelenlegi fogása {jelenfogas} kg.";


                                nagyhalmennyiseg.Clear();

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
                    MessageBox.Show("Töltse ki a mezőt!");
                }
            }
            else
            {
                MessageBox.Show("Válasszon ki egy versenyzőt!");
            }
        }
    }
}
