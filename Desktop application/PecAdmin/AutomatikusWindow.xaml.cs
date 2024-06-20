using Microsoft.Win32;

using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.IO;
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
using Microsoft.Office.Interop.Excel;

namespace PecAdmin
{
    /// <summary>
    /// Interaction logic for AutomatikusWindow.xaml
    /// </summary>
    public partial class AutomatikusWindow : System.Windows.Window
    {
        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);
        public static string versenynev = string.Empty;
        string ered;

        List<string> eredmenyekLista = new List<string>();


        public AutomatikusWindow()
        {
            InitializeComponent();
            valaszto.Items.Clear();
            string select = $"SELECT hirdetes.versenynev FROM `hirdetes`";
            connect.Open();
            MySqlCommand Select_cmd = new MySqlCommand(select, connect);
            MySqlDataReader Reader = Select_cmd.ExecuteReader();
            while (Reader.Read())
            {
                valaszto.Items.Add(Reader[0]);

            }

            connect.Close();

         
            merlegeles.IsEnabled = false;
            jelenlegiEred.IsEnabled = false;
            mentes.IsEnabled = false;
            szerkesztes.IsEnabled = false;
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


        private void DataGrid_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {



        }

        private void frissites_Click(object sender, RoutedEventArgs e)
        {


            String select = $"SELECT nev, szektor, allas, fogas, nagyhal FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{valaszto.SelectedItem}' Order by allas asc;";
            MySqlCommand cmd = new MySqlCommand(select, connect);
            connect.Open();
            MySqlDataAdapter Adapter = new MySqlDataAdapter(cmd);
            DataSet ds = new DataSet();
            Adapter.Fill(ds, "LoadDataBinding");
            tablazat.DataContext = ds;
            connect.Close();

            valaszto.Items.Clear();
            string select2 = $"SELECT hirdetes.versenynev FROM `hirdetes`";
            connect.Open();
            MySqlCommand Select2_cmd = new MySqlCommand(select2, connect);
            MySqlDataReader Reader2 = Select2_cmd.ExecuteReader();
            while (Reader2.Read())
            {
                valaszto.Items.Add(Reader2[0]);

            }
            connect.Close();



        }

        private void Versenyvalasztas(object sender, SelectionChangedEventArgs e)
        {
            if (valaszto.SelectedItem != null)
            {

                versenynev = valaszto.SelectedItem.ToString();
                String select = $"SELECT nev, szektor, allas, fogas, nagyhal FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{valaszto.SelectedItem}' Order by allas asc;";
                MySqlCommand cmd = new MySqlCommand(select, connect);
                connect.Open();
                MySqlDataAdapter Adapter = new MySqlDataAdapter(cmd);
                DataSet ds = new DataSet();
                Adapter.Fill(ds, "LoadDataBinding");
                tablazat.DataContext = ds;

                merlegeles.IsEnabled = true;
                jelenlegiEred.IsEnabled = true;
                mentes.IsEnabled = true;
                szerkesztes.IsEnabled = true;
                connect.Close();
            }




        }

        private void merlegeles_Click(object sender, RoutedEventArgs e)
        {
            AutomatikusEgyeniMerlegel AutomatikusEgyeniMerlegel = new AutomatikusEgyeniMerlegel();
            AutomatikusEgyeniMerlegel.Show();
        }

        private void jelenlegiEred_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                List<string> overallOsszes = new List<string>();
                List<string> SzektorOsszes = new List<string>();
                int szektorok = 0;
                int szamlal = 1;


                string select2 = $"SELECT max(szektor) FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}';";
                connect.Open();
                MySqlCommand Select2_cmd = new MySqlCommand(select2, connect);
                MySqlDataReader Reader2 = Select2_cmd.ExecuteReader();
                while (Reader2.Read())
                {
                    szektorok = int.Parse(Reader2[0].ToString());

                }
                connect.Close();

                connect.Open();


                string overallSelect = $"SELECT nev, fogas FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' ORDER by fogas DESC limit 3;";
                MySqlCommand overallCmd = new MySqlCommand(overallSelect, connect);
                MySqlDataReader overallOlvaso = overallCmd.ExecuteReader();
                while (overallOlvaso.Read())
                {

                    eredmenyekLista.Add($"Összesített {szamlal}. helyezett: {overallOlvaso[0]} {overallOlvaso[1]}kg");
                    szamlal++;

                }
                connect.Close();
                connect.Open();


                for (int i = 0; i < szektorok; i++)
                {
                    szamlal = 1;
                    connect.Close();
                    connect.Open();
                    string szektorSelect = $"SELECT nev, fogas FROM `jelentkezs`INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and szektor = {i + 1} ORDER by fogas desc LIMIT 3;";
                    MySqlCommand szektorCmd = new MySqlCommand(szektorSelect, connect);
                    MySqlDataReader szektorolvaso = szektorCmd.ExecuteReader();
                    while (szektorolvaso.Read())
                    {

                        eredmenyekLista.Add($"{i + 1}. Szektor {szamlal}. helyezett: {szektorolvaso[0]} {szektorolvaso[1]}kg");
                        szamlal++;

                    }
                }
                connect.Close();
                connect.Open();
                string nagyhalSelect = $"SELECT nev, nagyhal FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' order by nagyhal desc LIMIT 1;";
                MySqlCommand nagyhalcmd = new MySqlCommand(nagyhalSelect, connect);
                MySqlDataReader nagyhalOlvaso = nagyhalcmd.ExecuteReader();
                while (nagyhalOlvaso.Read())
                {
                    eredmenyekLista.Add($"Nagyhal Díj: {nagyhalOlvaso[0]} {nagyhalOlvaso[1]}kg.");
                }

                connect.Close();


                connect.Open();
                string mazliSelect = $"SELECT nev, nagyhal, mazli FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and mazli != 0;";
                MySqlCommand mazlicmd = new MySqlCommand(mazliSelect, connect);
                MySqlDataReader mazliOlvaso = mazlicmd.ExecuteReader();
                while (mazliOlvaso.Read())
                {
                    eredmenyekLista.Add($"Mázli Díj: {mazliOlvaso[0]} {mazliOlvaso[1]}kg {mazliOlvaso[2]}-kor.");
                }

                connect.Close();


                connect.Close();
                connect.Open();
                string Citrom_select = $"SELECT allas, nev, fogas FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and fogas != 0 ORDER by fogas asc limit 1;";
                MySqlCommand Citrom_cmd = new MySqlCommand(Citrom_select, connect);
                MySqlDataReader Citrom_olvaso = Citrom_cmd.ExecuteReader();
                while (Citrom_olvaso.Read())
                {
                    eredmenyekLista.Add($"Citrom Díj: {Citrom_olvaso[1]} {Citrom_olvaso[2]}kg.");
                }

                connect.Close();


                var message = string.Join(" \n", eredmenyekLista);
                MessageBox.Show(message);
                ered = message;


                eredmenyekLista.Clear();
                SzektorOsszes.Clear();
                overallOsszes.Clear();
                ered = string.Empty;
                message = string.Empty;
                szektorok = 0;
            }
            catch
            {
                connect.Close();
                MessageBox.Show("Hiba");
            }

            

        }

        private void mentes_Click(object sender, RoutedEventArgs e)
        {
            //www.youtube.com/watch?v=_Hn4hbe1NxM
            //www.youtube.com/watch?v=2FeS-Raf0lA

            try
            {

                Microsoft.Office.Interop.Excel.Application app = new Microsoft.Office.Interop.Excel.Application();
                

                Workbook eredmenyexel = app.Workbooks.Add();
                Worksheet Munka1 = eredmenyexel.Worksheets["Munka1"];
                Munka1.Range["A:A"].ColumnWidth = 21.5;
                Munka1.Range["B:B"].ColumnWidth = 20;
                Munka1.Range["C:C"].ColumnWidth = 8;
                Munka1.Range["D:D"].ColumnWidth = 5;
                Munka1.Range["E:E"].ColumnWidth = 21.5;
                Munka1.Range["F:F"].ColumnWidth = 20;
                Munka1.Range["G:G"].ColumnWidth = 8;
                Munka1.Range["H:H"].ColumnWidth = 5;
                Munka1.Range["I:I"].ColumnWidth = 21.5;
                Munka1.Range["J:J"].ColumnWidth = 20;
                Munka1.Range["K:K"].ColumnWidth = 8;





                //learn.microsoft.com/en-us/docs/

                int szektorok = 0;
                int szamlal = 0;




                Munka1.Range["C1"].Value = "Összesített Erdmények";
                Munka1.Range["A1:C1"].Merge();
                Munka1.Range["E1:G1"].Merge();

                Munka1.Range["E1"].Value = "Szektor eredmények";
                Munka1.Range["I1"].Value = "Számolt eredmények";
                Munka1.Range["I1:K1"].Merge();


                connect.Open();
                string overallSelect = $"SELECT nev, fogas FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' ORDER by fogas DESC;";
                MySqlCommand overallCmd = new MySqlCommand(overallSelect, connect);
                MySqlDataReader overallOlvaso = overallCmd.ExecuteReader();
                while (overallOlvaso.Read())
                {
                    szamlal++;

                    Munka1.Range["A" + (szamlal + 2)].Value = "Összesített " + szamlal + ". helyezett: ";
                    Munka1.Range["B" + (szamlal + 2)].Value = overallOlvaso[0];
                    Munka1.Range["C" + (szamlal + 2)].Value = overallOlvaso[1] + "kg";

                }
                connect.Close();



                connect.Open();
                string select2 = $"SELECT max(szektor) FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}';";
                MySqlCommand Select2_cmd = new MySqlCommand(select2, connect);
                MySqlDataReader Reader2 = Select2_cmd.ExecuteReader();
                while (Reader2.Read())
                {
                    szektorok = int.Parse(Reader2[0].ToString());

                }



                connect.Close();
                connect.Open();

                int sorszamlalo = 1;
                for (int i = 0; i < szektorok; i++)
                {
                    szamlal = 1;

                    connect.Close();
                    connect.Open();
                    string szektorSelect = $"SELECT nev, fogas FROM `jelentkezs`INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and szektor = {i + 1} ORDER by fogas desc;";
                    MySqlCommand szektorCmd = new MySqlCommand(szektorSelect, connect);
                    MySqlDataReader szektorolvaso = szektorCmd.ExecuteReader();
                    while (szektorolvaso.Read())
                    {
                        sorszamlalo++;
                        Munka1.Range["E" + (sorszamlalo + 1)].Value = $"{i + 1}. Szektor {szamlal}. helyezett: ";
                        Munka1.Range["F" + (sorszamlalo + 1)].Value = szektorolvaso[0];
                        Munka1.Range["G" + (sorszamlalo + 1)].Value = szektorolvaso[1] + "kg";
                        szamlal++;
                    }
                    sorszamlalo++;
                }
                connect.Close();

                connect.Open();
                szamlal = 0;
                string nagyhalSelect = $"SELECT nev, nagyhal FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and nagyhal != 0 Order by nagyhal desc;";
                MySqlCommand nagyhalcmd = new MySqlCommand(nagyhalSelect, connect);
                MySqlDataReader nagyhalOlvaso = nagyhalcmd.ExecuteReader();
                while (nagyhalOlvaso.Read())
                {
                    szamlal++;

                    Munka1.Range["I" + (szamlal + 2)].Value = "Nagyhallista " + szamlal + ". helyezett: ";
                    Munka1.Range["J" + (szamlal + 2)].Value = nagyhalOlvaso[0];
                    Munka1.Range["K" + (szamlal + 2)].Value = nagyhalOlvaso[1] + "kg";
                }

                connect.Close();
                connect.Open();
                string mazliSelect = $"SELECT nev, nagyhal, mazli FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and mazli != 0;";
                MySqlCommand mazlicmd = new MySqlCommand(mazliSelect, connect);
                MySqlDataReader mazliOlvaso = mazlicmd.ExecuteReader();
                while (mazliOlvaso.Read())
                {
                    szamlal++;
                    szamlal++;


                    Munka1.Range["I" + (szamlal + 2)].Value = "Mázli Díj: " + mazliOlvaso[2] + "-kor";
                    Munka1.Range["J" + (szamlal + 2)].Value = mazliOlvaso[0];
                    Munka1.Range["K" + (szamlal + 2)].Value = mazliOlvaso[1] + "kg";
                }

                connect.Close();


                connect.Close();
                connect.Open();
                string Citrom_select = $"SELECT nev, fogas FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}' and fogas != 0 ORDER by fogas asc limit 1;";
                MySqlCommand Citrom_cmd = new MySqlCommand(Citrom_select, connect);
                MySqlDataReader Citrom_olvaso = Citrom_cmd.ExecuteReader();
                while (Citrom_olvaso.Read())
                {
                    szamlal++;
                    Munka1.Range["I" + (szamlal + 2)].Value = "Citrom Díj: ";
                    Munka1.Range["J" + (szamlal + 2)].Value = Citrom_olvaso[0];
                    Munka1.Range["K" + (szamlal + 2)].Value = Citrom_olvaso[1] + "kg";
                }

                connect.Close();
                connect.Open();
                string ossz_select = $"SELECT sum(fogas) FROM `jelentkezs` INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId WHERE hirdetes.versenynev = '{versenynev}'";
                MySqlCommand ossz_cmd = new MySqlCommand(ossz_select, connect);
                MySqlDataReader ossz_olvaso = ossz_cmd.ExecuteReader();
                while (ossz_olvaso.Read())
                {
                    szamlal++;
                    szamlal++;
                    Munka1.Range["I" + (szamlal + 2)].Value = "Összfogás: ";
                    Munka1.Range["J" + (szamlal + 2)].Value = ossz_olvaso[0] + "kg";
                }
                app.Visible = true;
                connect.Close();
            }
            catch (Exception)
            {
                connect.Close();
                MessageBox.Show("Hiba");
            }





        }

        private void hozzarendeles_Click(object sender, RoutedEventArgs e)
        {
            automatikusHozzarendeles automatikusHozzarendeles = new automatikusHozzarendeles();
            automatikusHozzarendeles.Show();
        }

        private void szerkesztes_Click(object sender, RoutedEventArgs e)
        {
            AutomataSzerkesztes automataSzerkesztes = new AutomataSzerkesztes();
            automataSzerkesztes.Show();
        }
    }
}
