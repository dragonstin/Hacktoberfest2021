import java.util.Scanner;

public class insertion_sort {
    public static void Sort(int a[]) {
        int n = a.length, i, j, temp;
        for (i = 1; i < n; i++) {

            for (j = i - 1; j >= 0 && a[j + 1] < a[j]; j--) {
                temp = a[j + 1];
                a[j + 1] = a[j];
                a[j] = temp;

            }

        }
    }

    public static void printarray(int a[]) {
        for (int i = 0; i < a.length; i++) {

            System.out.print(a[i] + " ");
        }

    }

    public static void main(String[] args) {
        int n, i;
        Scanner scanner = new Scanner(System.in);
        System.out.print("Enter number of elements in the array:");
        n = scanner.nextInt();
        int a[] = new int[n];
        System.out.println("Enter " + n + " elements ");
        for (i = 0; i < n; i++) {
            a[i] = scanner.nextInt();
        }

        System.out.println("elements in array ");
        printarray(a);
        Sort(a);
        System.out.println("\nelements after sorting");
        printarray(a);
        scanner.close();
    }

}